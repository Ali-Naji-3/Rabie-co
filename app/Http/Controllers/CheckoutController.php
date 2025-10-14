<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->final_price * $item->quantity;
        });

        $shipping = $subtotal >= 100 ? 0 : 10; // Free shipping over $100
        $total = $subtotal + $shipping; // No tax

        return view('checkout', compact('cartItems', 'subtotal', 'shipping', 'total'));
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
            'billing_address' => 'nullable|required_if:billing_same,false|string',
            'billing_city' => 'nullable|required_if:billing_same,false|string',
            'billing_state' => 'nullable|required_if:billing_same,false|string',
            'billing_postal_code' => 'nullable|required_if:billing_same,false|string',
            'billing_country' => 'nullable|required_if:billing_same,false|string',
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

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->final_price * $item->quantity;
        });

        $shipping = $subtotal >= 100 ? 0 : 10;
        $total = $subtotal + $shipping; // No tax

        // Prepare addresses
        $shippingAddress = [
            'name' => $validated['name'],
            'address' => $validated['address'],
            'address_2' => $validated['address_2'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country'],
            'phone' => $validated['phone'],
        ];

        $billingSame = in_array($request->billing_same, ['on', '1', 'true', 1, true]);
        $billingAddress = $billingSame ? $shippingAddress : [
            'name' => $validated['name'],
            'address' => $validated['billing_address'],
            'city' => $validated['billing_city'],
            'state' => $validated['billing_state'],
            'postal_code' => $validated['billing_postal_code'],
            'country' => $validated['billing_country'],
            'phone' => $validated['phone'],
        ];

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'subtotal' => $subtotal,
                'tax' => 0, // No tax
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => $validated['payment_method'] === 'cod' ? 'pending' : 'pending',
                'payment_method' => $validated['payment_method'],
                'shipping_address' => json_encode($shippingAddress),
                'billing_address' => json_encode($billingAddress),
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create order items and reduce stock
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->final_price,
                    'subtotal' => $cartItem->product->final_price * $cartItem->quantity,
                ]);

                // Reduce product stock
                $product = Product::find($cartItem->product_id);
                $product->stock -= $cartItem->quantity;
                $product->save();
            }

            // Clear cart
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            } else {
                Cart::where('session_id', session()->getId())->delete();
            }

            DB::commit();

            // Redirect to success page
            return redirect()->route('order.success', $order->id)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function success($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        // Verify order belongs to current user
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order-success', compact('order'));
    }
}
