<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('customer')) {
            $query->where('customerNumber', $request->customer);
        }
        return OrderResource::collection($query->orderByDesc('orderDate')->paginate(20));
    }

    public function show(Order $order)
    {
        return new OrderResource($order->load('customer', 'orderDetails.product'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'orderNumber'    => 'required|integer|unique:orders',
            'orderDate'      => 'required|date',
            'requiredDate'   => 'required|date',
            'status'         => 'required|string',
            'customerNumber' => 'required|integer|exists:customers,customerNumber',
        ]);
        return new OrderResource(Order::create($data));
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->only(['status', 'comments', 'shippedDate']));
        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
