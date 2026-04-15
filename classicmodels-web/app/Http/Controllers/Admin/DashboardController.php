<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Customer, Order, Product, Payment};
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => Customer::count(),
            'total_orders'    => Order::count(),
            'total_products'  => Product::count(),
            'total_revenue'   => Payment::sum('amount'),
            'pending_orders'  => Order::where('status', 'In Process')->count(),
        ];

        $recentOrders = Order::with('customer')
            ->orderByDesc('orderDate')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
