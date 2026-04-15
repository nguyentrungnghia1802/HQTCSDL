@extends('layouts.app')
@section('title', 'Order #'.$order->orderNumber)
@section('nav_orders', 'active')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <a href="{{ route('admin.orders.edit', $order->orderNumber) }}" class="btn btn-sm btn-warning ms-2">Edit Status</a>
</div>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header fw-semibold">Order Info</div>
            <div class="card-body">
                @php
                    $badges = ['Shipped'=>'success','In Process'=>'warning','Resolved'=>'info','Cancelled'=>'danger','On Hold'=>'secondary','Disputed'=>'dark'];
                    $badge = $badges[$order->status] ?? 'secondary';
                @endphp
                <table class="table table-sm table-borderless mb-0">
                    <tr><th>Order #</th><td>{{ $order->orderNumber }}</td></tr>
                    <tr><th>Status</th><td><span class="badge bg-{{ $badge }}">{{ $order->status }}</span></td></tr>
                    <tr><th>Order Date</th><td>{{ $order->orderDate }}</td></tr>
                    <tr><th>Required Date</th><td>{{ $order->requiredDate }}</td></tr>
                    <tr><th>Shipped Date</th><td>{{ $order->shippedDate ?? '—' }}</td></tr>
                    <tr><th>Customer</th><td>
                        @if($order->customer)
                            <a href="{{ route('admin.customers.show', $order->customerNumber) }}">{{ $order->customer->customerName }}</a>
                        @else — @endif
                    </td></tr>
                    <tr><th>Comments</th><td>{{ $order->comments ?? '—' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header fw-semibold">Order Details</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr><th>Line</th><th>Product</th><th>Qty</th><th>Price Each</th><th>Subtotal</th></tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach($order->orderDetails as $od)
                            @php $sub = $od->quantityOrdered * $od->priceEach; $grandTotal += $sub; @endphp
                            <tr>
                                <td>{{ $od->orderLineNumber }}</td>
                                <td>
                                    <a href="{{ route('admin.products.show', $od->productCode) }}">{{ $od->product->productName ?? $od->productCode }}</a>
                                </td>
                                <td>{{ $od->quantityOrdered }}</td>
                                <td>${{ number_format($od->priceEach, 2) }}</td>
                                <td>${{ number_format($sub, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr><th colspan="4" class="text-end">Grand Total:</th><th>${{ number_format($grandTotal, 2) }}</th></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
