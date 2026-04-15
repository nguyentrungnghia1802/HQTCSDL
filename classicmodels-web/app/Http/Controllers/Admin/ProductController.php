<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Productline;
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
        $products = $query->orderBy('productName')->paginate(15)->withQueryString();
        $lines = Productline::pluck('productLine');
        $search = $request->get('search', '');
        $filterLine = $request->get('line', '');
        return view('admin.products.index', compact('products', 'lines', 'search', 'filterLine'));
    }

    public function show(Product $product)
    {
        $product->load('productline');
        return view('admin.products.show', compact('product'));
    }

    public function create()
    {
        $lines = Productline::pluck('productLine');
        return view('admin.products.create', compact('lines'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'productCode'        => 'required|string|max:15|unique:products',
            'productName'        => 'required|string|max:70',
            'productLine'        => 'required|string|exists:productlines,productLine',
            'productScale'       => 'required|string|max:10',
            'productVendor'      => 'required|string|max:50',
            'productDescription' => 'required|string',
            'quantityInStock'    => 'required|integer',
            'buyPrice'           => 'required|numeric',
            'MSRP'               => 'required|numeric',
        ]);
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $lines = Productline::pluck('productLine');
        return view('admin.products.edit', compact('product', 'lines'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'productName'        => 'required|string|max:70',
            'productLine'        => 'required|string|exists:productlines,productLine',
            'productScale'       => 'required|string|max:10',
            'productVendor'      => 'required|string|max:50',
            'productDescription' => 'required|string',
            'quantityInStock'    => 'required|integer',
            'buyPrice'           => 'required|numeric',
            'MSRP'               => 'required|numeric',
        ]);
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
}
