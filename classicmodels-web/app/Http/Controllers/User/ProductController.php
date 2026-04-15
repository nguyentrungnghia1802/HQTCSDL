<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Product, Productline};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('productline');
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('productName', 'like', "%$s%")
                  ->orWhere('productVendor', 'like', "%$s%");
        }
        if ($request->filled('line')) {
            $query->where('productLine', $request->line);
        }
        $products = $query->orderBy('productName')->paginate(12)->withQueryString();
        $lines = Productline::pluck('productLine');
        $search = $request->get('search', '');
        $filterLine = $request->get('line', '');
        return view('user.products.index', compact('products', 'lines', 'search', 'filterLine'));
    }

    public function show(Product $product)
    {
        $product->load('productline');
        return view('user.products.show', compact('product'));
    }
}
