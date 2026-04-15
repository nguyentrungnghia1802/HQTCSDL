@extends('layouts.app')
@section('title', $product->productName)
@section('nav_products', 'active')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <a href="{{ route('admin.products.edit', $product->productCode) }}" class="btn btn-sm btn-warning ms-2">Edit</a>
</div>
<div class="row g-3">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header fw-semibold">Product Details</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr><th>Code</th><td><code>{{ $product->productCode }}</code></td></tr>
                    <tr><th>Name</th><td>{{ $product->productName }}</td></tr>
                    <tr><th>Line</th><td><span class="badge bg-secondary">{{ $product->productLine }}</span></td></tr>
                    <tr><th>Scale</th><td>{{ $product->productScale }}</td></tr>
                    <tr><th>Vendor</th><td>{{ $product->productVendor }}</td></tr>
                    <tr><th>In Stock</th><td>{{ number_format($product->quantityInStock) }}</td></tr>
                    <tr><th>Buy Price</th><td>${{ number_format($product->buyPrice, 2) }}</td></tr>
                    <tr><th>MSRP</th><td>${{ number_format($product->MSRP, 2) }}</td></tr>
                </table>
                <hr>
                <p class="text-muted small">{{ $product->productDescription }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header fw-semibold">Orders containing this product</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr><th>Order#</th><th>Qty</th><th>Price Each</th><th>Subtotal</th></tr>
                        </thead>
                        <tbody>
                            @forelse($product->orderDetails as $od)
                            <tr>
                                <td><a href="{{ route('admin.orders.show', $od->orderNumber) }}">{{ $od->orderNumber }}</a></td>
                                <td>{{ $od->quantityOrdered }}</td>
                                <td>${{ number_format($od->priceEach, 2) }}</td>
                                <td>${{ number_format($od->quantityOrdered * $od->priceEach, 2) }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-muted text-center py-2">No order history.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
