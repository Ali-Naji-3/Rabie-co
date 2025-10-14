<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('my-orders', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->findOrFail($orderId);

        return view('order-details', compact('order'));
    }
}
