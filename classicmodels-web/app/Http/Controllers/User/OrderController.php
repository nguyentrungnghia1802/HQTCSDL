<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer')->orderByDesc('orderDate');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $orders = $query->paginate(15)->withQueryString();
        $statuses = ['Shipped', 'Resolved', 'Cancelled', 'On Hold', 'In Process', 'Disputed'];
        $filterStatus = $request->get('status', '');
        return view('user.orders.index', compact('orders', 'statuses', 'filterStatus'));
    }

    public function show(Order $order)
    {
        $order->load('customer', 'orderDetails.product');
        return view('user.orders.show', compact('order'));
    }
}
