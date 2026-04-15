@extends('layouts.app')
@section('title', 'Search Results')

@section('content')
@php
    $customers = $results['customers'] ?? collect();
    $products  = $results['products'] ?? collect();
    $orders    = $results['orders'] ?? collect();
@endphp
<h5 class="mb-3">
    Search results for: <strong>"{{ $query }}"</strong>
    <small class="text-muted">
        ({{ count($customers) + count($products) + count($orders) }} results)
    </small>
</h5>

<ul class="nav nav-tabs mb-3" id="searchTabs">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-customers">
            Customers <span class="badge bg-primary">{{ count($customers) }}</span>
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-products">
            Products <span class="badge bg-secondary">{{ count($products) }}</span>
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-orders">
            Orders <span class="badge bg-success">{{ count($orders) }}</span>
        </button>
    </li>
</ul>

<div class="tab-content">
    <!-- Customers -->
    <div class="tab-pane fade show active" id="tab-customers">
        @if($customers->isEmpty())
            <p class="text-muted py-3">No customers found.</p>
        @else
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>#</th><th>Name</th><th>Contact</th><th>City</th><th>Country</th><th></th></tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $c)
                        <tr>
                            <td>{{ $c->customerNumber }}</td>
                            <td>{{ $c->customerName }}</td>
                            <td>{{ $c->contactFirstName }} {{ $c->contactLastName }}</td>
                            <td>{{ $c->city }}</td>
                            <td>{{ $c->country }}</td>
                            <td>
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.customers.show', $c->customerNumber) }}" class="btn btn-sm btn-outline-info">View</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    <!-- Products -->
    <div class="tab-pane fade" id="tab-products">
        @if($products->isEmpty())
            <p class="text-muted py-3">No products found.</p>
        @else
        <div class="row g-3">
            @foreach($products as $p)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="badge bg-secondary mb-1">{{ $p->productLine }}</span>
                        <h6>{{ $p->productName }}</h6>
                        <small class="text-muted">{{ $p->productVendor }}</small>
                        <p class="fw-bold text-primary mt-1 mb-0">${{ number_format($p->MSRP, 2) }}</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.products.show', $p->productCode) }}" class="btn btn-sm btn-outline-primary w-100">View</a>
                        @else
                            <a href="{{ route('user.products.show', $p->productCode) }}" class="btn btn-sm btn-outline-primary w-100">View</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Orders -->
    <div class="tab-pane fade" id="tab-orders">
        @if($orders->isEmpty())
            <p class="text-muted py-3">No orders found.</p>
        @else
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>#</th><th>Customer</th><th>Date</th><th>Status</th><th></th></tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $o)
                        <tr>
                            <td>{{ $o->orderNumber }}</td>
                            <td>{{ $o->customer->customerName ?? '—' }}</td>
                            <td>{{ $o->orderDate }}</td>
                            <td><span class="badge bg-secondary">{{ $o->status }}</span></td>
                            <td>
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.orders.show', $o->orderNumber) }}" class="btn btn-sm btn-outline-info">View</a>
                                @else
                                    <a href="{{ route('user.orders.show', $o->orderNumber) }}" class="btn btn-sm btn-outline-info">View</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
