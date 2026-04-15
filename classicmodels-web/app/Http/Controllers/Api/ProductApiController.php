<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('productline');
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('productName', 'like', "%$s%")
                  ->orWhere('productLine', 'like', "%$s%");
        }
        if ($request->filled('line')) {
            $query->where('productLine', $request->line);
        }
        return ProductResource::collection($query->paginate(20));
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load('productline'));
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
        return new ProductResource(Product::create($data));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
