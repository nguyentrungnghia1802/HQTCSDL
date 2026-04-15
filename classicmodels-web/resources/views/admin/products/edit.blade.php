@extends('layouts.app')
@section('title', 'Edit Product')
@section('nav_products', 'active')

@section('content')
<div class="mb-3"><a href="{{ route('admin.products.show', $product->productCode) }}" class="btn btn-sm btn-outline-secondary">← Back</a></div>
<div class="card" style="max-width:700px;">
    <div class="card-header fw-semibold">Edit Product: {{ $product->productCode }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.update', $product->productCode) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="productName" class="form-control" value="{{ old('productName', $product->productName) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Product Line *</label>
                    <select name="productLine" class="form-select" required>
                        @foreach($lines as $pl)
                            <option value="{{ $pl }}" {{ old('productLine', $product->productLine) == $pl ? 'selected' : '' }}>{{ $pl }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Scale *</label>
                    <input type="text" name="productScale" class="form-control" value="{{ old('productScale', $product->productScale) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Vendor *</label>
                    <input type="text" name="productVendor" class="form-control" value="{{ old('productVendor', $product->productVendor) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Quantity In Stock *</label>
                    <input type="number" name="quantityInStock" class="form-control" value="{{ old('quantityInStock', $product->quantityInStock) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Buy Price *</label>
                    <input type="number" step="0.01" name="buyPrice" class="form-control" value="{{ old('buyPrice', $product->buyPrice) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">MSRP *</label>
                    <input type="number" step="0.01" name="MSRP" class="form-control" value="{{ old('MSRP', $product->MSRP) }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="productDescription" class="form-control" rows="3">{{ old('productDescription', $product->productDescription) }}</textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
