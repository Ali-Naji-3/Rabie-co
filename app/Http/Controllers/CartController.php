<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
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

        $subtotal = $cartItems->sum(function($item) {
            return $item->product->final_price * $item->quantity;
        });

        $shipping = $subtotal >= 100 ? 0 : 10; // Free shipping over $100
        $total = $subtotal + $shipping; // Total without tax

        return view('cart', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available');
        }

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();
            
            if ($cart) {
                // Check if total quantity exceeds stock
                if ($product->stock < ($cart->quantity + $request->quantity)) {
                    return back()->with('error', 'Not enough stock available');
                }
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);
            }
        } else {
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', $sessionId)
                ->where('product_id', $request->product_id)
                ->first();
            
            if ($cart) {
                // Check if total quantity exceeds stock
                if ($product->stock < ($cart->quantity + $request->quantity)) {
                    return back()->with('error', 'Not enough stock available');
                }
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                Cart::create([
                    'session_id' => $sessionId,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);
            }
        }

        return back()->with('success', 'Product added to cart');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::findOrFail($id);
        
        if ($cart->product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available');
        }

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated');
    }

    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return back()->with('success', 'Item removed from cart');
    }
}
