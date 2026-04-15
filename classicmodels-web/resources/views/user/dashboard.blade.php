@extends('layouts.app')
@section('title', 'Welcome')
@section('nav_dashboard', 'active')

@section('content')
<div class="mb-4">
    <h4>Welcome, {{ auth()->user()->name }}!</h4>
    <p class="text-muted">Browse our classic model car collection.</p>
</div>

<!-- Product Lines -->
<h5 class="mb-3">Product Lines</h5>
<div class="row g-3 mb-4">
    @foreach($productLines as $pl)
    <div class="col-md-3">
        <a href="{{ route('user.products.index', ['line'=>$pl->productLine]) }}" class="text-decoration-none">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="bi bi-box-seam fs-2 text-primary"></i>
                    <div class="fw-semibold mt-2">{{ $pl->productLine }}</div>
                    <small class="text-muted">{{ $pl->products_count }} products</small>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<!-- Featured Products -->
<h5 class="mb-3">Featured Products</h5>
<div class="row g-3 mb-4">
    @foreach($featuredProducts as $p)
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <span class="badge bg-secondary mb-2">{{ $p->productLine }}</span>
                <h6 class="card-title">{{ $p->productName }}</h6>
                <p class="text-muted small mb-1">{{ $p->productVendor }} · {{ $p->productScale }}</p>
                <p class="fw-bold text-primary">${{ number_format($p->MSRP, 2) }}</p>
            </div>
            <div class="card-footer bg-transparent">
                <a href="{{ route('user.products.show', $p->productCode) }}" class="btn btn-sm btn-outline-primary w-100">View Details</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Recent Orders -->
<h5 class="mb-3">My Recent Orders</h5>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Date</th><th>Required</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $o)
                @php $badges=['Shipped'=>'success','In Process'=>'warning','Resolved'=>'info','Cancelled'=>'danger','On Hold'=>'secondary','Disputed'=>'dark']; @endphp
                <tr>
                    <td><strong>{{ $o->orderNumber }}</strong></td>
                    <td>{{ $o->orderDate }}</td>
                    <td>{{ $o->requiredDate }}</td>
                    <td><span class="badge bg-{{ $badges[$o->status] ?? 'secondary' }}">{{ $o->status }}</span></td>
                    <td><a href="{{ route('user.orders.show', $o->orderNumber) }}" class="btn btn-sm btn-outline-secondary">View</a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-3">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
