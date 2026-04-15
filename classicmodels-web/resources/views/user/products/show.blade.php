@extends('layouts.app')
@section('title', $product->productName)
@section('nav_products', 'active')

@section('content')
<div class="mb-3"><a href="{{ route('user.products.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a></div>
<div class="card" style="max-width:700px;">
    <div class="card-header fw-semibold">{{ $product->productName }}</div>
    <div class="card-body">
        <span class="badge bg-secondary mb-3">{{ $product->productLine }}</span>
        <table class="table table-sm table-borderless mb-3">
            <tr><th>Code</th><td><code>{{ $product->productCode }}</code></td></tr>
            <tr><th>Scale</th><td>{{ $product->productScale }}</td></tr>
            <tr><th>Vendor</th><td>{{ $product->productVendor }}</td></tr>
            <tr><th>In Stock</th><td>{{ number_format($product->quantityInStock) }} units</td></tr>
            <tr><th>Price (MSRP)</th><td class="fw-bold text-primary">${{ number_format($product->MSRP, 2) }}</td></tr>
        </table>
        <p class="text-muted">{{ $product->productDescription }}</p>
    </div>
</div>
@endsection
