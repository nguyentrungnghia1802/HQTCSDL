<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Product, Order, Productline};

class DashboardController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::inRandomOrder()->limit(6)->get();
        $productLines = Productline::withCount('products')->get();
        $recentOrders = Order::with('customer')
            ->orderByDesc('orderDate')
            ->limit(5)
            ->get();
        return view('user.dashboard', compact('featuredProducts', 'productLines', 'recentOrders'));
    }
}
