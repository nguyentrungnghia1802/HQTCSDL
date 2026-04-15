<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer');
        if ($request->filled('search')) {
            $s = $request->search;
            $query->whereHas('customer', fn($q) => $q->where('customerName', 'like', "%$s%"))
                  ->orWhere('orderNumber', $s);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $orders = $query->orderByDesc('orderDate')->paginate(15)->withQueryString();
        $statuses = ['Shipped', 'Resolved', 'Cancelled', 'On Hold', 'In Process', 'Disputed'];
        $search = $request->get('search', '');
        $filterStatus = $request->get('status', '');
        return view('admin.orders.index', compact('orders', 'statuses', 'search', 'filterStatus'));
    }

    public function show(Order $order)
    {
        $order->load('customer', 'orderDetails.product');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $statuses = ['Shipped', 'Resolved', 'Cancelled', 'On Hold', 'In Process', 'Disputed'];
        return view('admin.orders.edit', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status'   => 'required|string',
            'comments' => 'nullable|string',
        ]);
        $order->update($data);
        return redirect()->route('admin.orders.index')->with('success', 'Order updated.');
    }
}
