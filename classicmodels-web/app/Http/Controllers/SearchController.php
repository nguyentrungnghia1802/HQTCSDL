<?php

namespace App\Http\Controllers;

use App\Models\{Customer, Product, Order};
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $results = [];

        if (strlen($query) >= 2) {
            $results['customers'] = Customer::where('customerName', 'like', "%$query%")
                ->orWhere('city', 'like', "%$query%")
                ->orWhere('country', 'like', "%$query%")
                ->limit(10)->get();

            $results['products'] = Product::where('productName', 'like', "%$query%")
                ->orWhere('productVendor', 'like', "%$query%")
                ->orWhere('productLine', 'like', "%$query%")
                ->limit(10)->get();

            $results['orders'] = Order::where('orderNumber', 'like', "%$query%")
                ->orWhereHas('customer', fn($q) => $q->where('customerName', 'like', "%$query%"))
                ->with('customer')
                ->limit(10)->get();
        }

        return view('search.results', compact('query', 'results'));
    }
}
