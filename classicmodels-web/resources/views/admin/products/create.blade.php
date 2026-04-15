@extends('layouts.app')
@section('title', 'New Product')
@section('nav_products', 'active')

@section('content')
<div class="mb-3"><a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a></div>
<div class="card" style="max-width:700px;">
    <div class="card-header fw-semibold">Add New Product</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Product Code *</label>
                    <input type="text" name="productCode" class="form-control" value="{{ old('productCode') }}" placeholder="S10_1234" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="productName" class="form-control" value="{{ old('productName') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Product Line *</label>
                    <select name="productLine" class="form-select" required>
                        <option value="">Select Line</option>
                        @foreach($lines as $pl)
                            <option value="{{ $pl }}" {{ old('productLine') == $pl ? 'selected' : '' }}>{{ $pl }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Scale *</label>
                    <input type="text" name="productScale" class="form-control" value="{{ old('productScale') }}" placeholder="1:10" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Vendor *</label>
                    <input type="text" name="productVendor" class="form-control" value="{{ old('productVendor') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Quantity In Stock *</label>
                    <input type="number" name="quantityInStock" class="form-control" value="{{ old('quantityInStock', 0) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Buy Price *</label>
                    <input type="number" step="0.01" name="buyPrice" class="form-control" value="{{ old('buyPrice') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">MSRP *</label>
                    <input type="number" step="0.01" name="MSRP" class="form-control" value="{{ old('MSRP') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="productDescription" class="form-control" rows="3">{{ old('productDescription') }}</textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
