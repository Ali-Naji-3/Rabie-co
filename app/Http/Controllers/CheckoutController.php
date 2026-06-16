<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotification;
use App\Models\AuditLog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show()
    {
        // Get cart items
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get();
        } else {
            $sessionId = session()->getId();
            $cartItems = Cart::where('session_id', $sessionId)
                ->with('product')
                ->get();
        }

        // Check if cart is empty
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }

        ['subtotal' => $subtotal, 'shipping' => $shipping, 'tax' => $tax, 'total' => $total]
            = (new PricingService())->calculate($cartItems);

        return view('checkout', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function process(Request $request)
    {
        // Validate checkout form
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|min:3',
            'address_2' => 'nullable|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:100',
            'billing_same' => 'nullable|in:on,off,1,0,true,false',
            'billing_address' => 'nullable|string',
            'billing_city' => 'nullable|string',
            'billing_state' => 'nullable|string',
            'billing_postal_code' => 'nullable|string',
            'billing_country' => 'nullable|string',
            'payment_method' => 'required|in:cod,card,bank_transfer',
            'notes' => 'nullable|string|max:500',
        ]);

        // Get cart items
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get();
        } else {
            $sessionId = session()->getId();
            $cartItems = Cart::where('session_id', $sessionId)
                ->with('product')
                ->get();
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }

        ['subtotal' => $subtotal, 'shipping' => $shipping, 'tax' => $tax, 'total' => $total]
            = (new PricingService())->calculate($cartItems);

        // Prepare addresses
        $shippingAddress = [
            'name' => $validated['name'],
            'address' => $validated['address'],
            'address_2' => $validated['address_2'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'] ?? null,
            'postal_code' => $validated['postal_code'] ?? null,
            'country' => $validated['country'],
            'phone' => $validated['phone'],
        ];

        // Check if billing is same as shipping (default to true if not specified)
        $billingSame = in_array($request->billing_same, ['on', '1', 'true', 1, true]) || !$request->has('billing_same');

        if ($billingSame || empty($validated['billing_address'])) {
            $billingAddress = $shippingAddress;
        } else {
            $billingAddress = [
                'name'        => $validated['name'],
                'address'     => $validated['billing_address'],
                'city'        => $validated['billing_city'] ?? $validated['city'],
                'state'       => $validated['billing_state'] ?? $validated['state'] ?? null,
                'postal_code' => $validated['billing_postal_code'] ?? $validated['postal_code'] ?? null,
                'country'     => $validated['billing_country'] ?? $validated['country'],
                'phone'       => $validated['phone'],
            ];
        }

        $order = null;

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_email' => $validated['email'],
                'order_number' => 'ORD-' . date('Ymd') . '-' . Str::upper(Str::random(10)),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'shipping_address' => json_encode($shippingAddress),
                'billing_address' => json_encode($billingAddress),
                'notes' => $validated['notes'] ?? null,
            ]);

            // Lock products in deterministic ID order to prevent deadlocks
            $productIds = $cartItems->pluck('product_id')->sort()->values()->all();
            $products = Product::whereIn('id', $productIds)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            // Re-validate stock under lock before any mutation
            foreach ($cartItems as $cartItem) {
                $product = $products->get($cartItem->product_id);
                if ($product->stock < $cartItem->quantity) {
                    DB::rollBack();
                    return back()->with('error',
                        "Sorry, \"{$product->name}\" only has {$product->stock} unit(s) left.");
                }
            }

            // All stock checks passed — create order items and atomically decrement
            foreach ($cartItems as $cartItem) {
                $product = $products->get($cartItem->product_id);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->final_price,
                    'subtotal' => $cartItem->product->final_price * $cartItem->quantity,
                ]);
                $product->decrement('stock', $cartItem->quantity);
            }

            // Clear cart
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            } else {
                Cart::where('session_id', session()->getId())->delete();
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again.');
        }

        try {
            AuditLog::record('order_created', $order, [], [
                'order_number'   => $order->order_number,
                'total'          => $order->total,
                'customer_email' => $order->customer_email,
            ]);
        } catch (\Throwable $e) {
            report($e);
        }

        try {
            $adminEmail = config('mail.admin_order_notification_email');
            if ($adminEmail) {
                $order->loadMissing('items.product');

                // Deferred until after the HTTP response is sent, and sent via the Resend
                // HTTP API (not SMTP) since outbound SMTP ports are blocked in production.
                dispatch(function () use ($order, $adminEmail) {
                    try {
                        $mailable = new NewOrderNotification($order);

                        Http::withToken(config('services.resend.key'))
                            ->post('https://api.resend.com/emails', [
                                'from'    => config('mail.from.name') . ' <' . config('services.resend.from') . '>',
                                'to'      => [$adminEmail],
                                'subject' => $mailable->envelope()->subject,
                                'html'    => $mailable->render(),
                            ])
                            ->throw();
                    } catch (\Throwable $e) {
                        report($e);
                    }
                })->afterResponse();
            }
        } catch (\Throwable $e) {
            report($e);
        }

        session(['last_completed_order_id' => $order->id]);

        return redirect()->route('order.success', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    public function success($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        $isOwner = Auth::id() !== null && $order->user_id === Auth::id();

        if (!$isOwner) {
            // Allow one-time session-authorized access (covers the post-checkout
            // redirect and future guest checkout). pull() consumes the key so the
            // URL cannot be revisited without re-owning the order.
            if ((int) session()->pull('last_completed_order_id') !== $order->id) {
                abort(403);
            }
        }

        return view('order-success', compact('order'));
    }
}
