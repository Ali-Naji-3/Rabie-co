<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Order;
use App\Models\Cart;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return response()->json($orders);
    }

    public function show(Request $request, $id)
    {
        $order = $request->user()
            ->orders()
            ->with('items.product')
            ->findOrFail($id);

        return response()->json($order);
    }

    public function store(Request $request)
    {
        /*
         * Shipping/billing address formats accepted (transition period):
         *
         * LEGACY — flat string (deprecated, still accepted):
         *   { "shipping_address": "123 Main St", "payment_method": "cod" }
         *   Stored as JSON: {"address":"123 Main St"}
         *
         * STRUCTURED — matches web checkout (preferred):
         *   { "name":"Ali", "address":"123 Main St", "city":"Riyadh",
         *     "country":"Saudi Arabia", "phone":"0501234567", "payment_method":"cod" }
         *   Stored as JSON: {"name":"Ali","address":"...","city":"...","country":"...","phone":"..."}
         *
         * Migration path: replace the flat "shipping_address" string with individual
         * address fields. Legacy support will be removed in a future major release.
         */

        if ($request->has('address')) {
            $validated = $request->validate([
                'email'          => 'nullable|email|max:255',
                'name'           => 'required|string|min:3|max:255',
                'address'        => 'required|string|min:3',
                'address_2'      => 'nullable|string',
                'city'           => 'required|string|max:100',
                'state'          => 'nullable|string|max:100',
                'postal_code'    => 'nullable|string|max:20',
                'country'        => 'required|string|max:100',
                'phone'          => 'required|string|max:20',
                'payment_method' => 'required|in:cod,card,bank_transfer',
                'notes'          => 'nullable|string|max:500',
            ]);

            $shippingAddress = json_encode([
                'name'        => $validated['name'],
                'address'     => $validated['address'],
                'address_2'   => $validated['address_2'] ?? null,
                'city'        => $validated['city'],
                'state'       => $validated['state'] ?? null,
                'postal_code' => $validated['postal_code'] ?? null,
                'country'     => $validated['country'],
                'phone'       => $validated['phone'],
            ]);
            $billingAddress = $shippingAddress;
        } else {
            $validated = $request->validate([
                'email'            => 'nullable|email|max:255',
                'shipping_address' => 'required|string',
                'billing_address'  => 'nullable|string',
                'payment_method'   => 'required|in:cod,card,bank_transfer',
                'notes'            => 'nullable|string|max:500',
            ]);

            $shippingAddress = json_encode(['address' => $validated['shipping_address']]);
            $billingAddress  = isset($validated['billing_address'])
                ? json_encode(['address' => $validated['billing_address']])
                : $shippingAddress;
        }

        $customerEmail = $validated['email'] ?? $request->user()->email;

        $order = null;

        DB::beginTransaction();

        try {
            $cartItems = Cart::where('user_id', $request->user()->id)
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                DB::rollBack();
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            // Lock products in deterministic ID order to prevent deadlocks
            $productIds = $cartItems->pluck('product_id')->sort()->values()->all();
            $products = \App\Models\Product::whereIn('id', $productIds)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            // Re-validate stock under lock before any mutation
            foreach ($cartItems as $item) {
                $product = $products->get($item->product_id);
                if ($product->stock < $item->quantity) {
                    DB::rollBack();
                    return response()->json([
                        'error' => "Insufficient stock for \"{$product->name}\". Available: {$product->stock}.",
                    ], 422);
                }
            }

            ['subtotal' => $subtotal, 'shipping' => $shipping, 'tax' => $tax, 'total' => $total]
                = (new PricingService())->calculate($cartItems);

            $order = Order::create([
                'user_id'          => $request->user()->id,
                'customer_email'   => $customerEmail,
                'order_number'     => 'ORD-' . date('Ymd') . '-' . Str::upper(Str::random(10)),
                'subtotal'         => $subtotal,
                'tax'              => $tax,
                'shipping'         => $shipping,
                'total'            => $total,
                'status'           => 'pending',
                'payment_status'   => 'pending',
                'payment_method'   => $validated['payment_method'],
                'shipping_address' => $shippingAddress,
                'billing_address'  => $billingAddress,
                'notes'            => $validated['notes'] ?? null,
            ]);

            // All stock checks passed — create order items and atomically decrement
            foreach ($cartItems as $item) {
                $product = $products->get($item->product_id);
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->final_price,
                    'subtotal'   => $item->product->final_price * $item->quantity,
                ]);
                $product->decrement('stock', $item->quantity);
            }

            // Clear cart
            Cart::where('user_id', $request->user()->id)->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create order'], 500);
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

        return response()->json([
            'message' => 'Order placed successfully',
            'order'   => $order->load('items.product'),
        ], 201);
    }
}
