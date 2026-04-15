@extends('layouts.app')
@section('title', 'Products')
@section('nav_products', 'active')

@section('content')
<div class="mb-3">
    <form method="GET" class="d-flex gap-2 flex-wrap">
        <input class="form-control" type="search" name="search" placeholder="Search products..." value="{{ $search }}" style="width:220px;">
        <select name="line" class="form-select" style="width:180px;">
            <option value="">All Lines</option>
            @foreach($lines as $pl)
                <option value="{{ $pl }}" {{ $filterLine == $pl ? 'selected' : '' }}>{{ $pl }}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-secondary">Filter</button>
        @if($search || $filterLine)<a href="{{ route('user.products.index') }}" class="btn btn-outline-secondary">Clear</a>@endif
    </form>
</div>

<div class="row g-3">
    @forelse($products as $p)
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <span class="badge bg-secondary mb-2">{{ $p->productLine }}</span>
                <h6 class="card-title">{{ $p->productName }}</h6>
                <p class="text-muted small mb-1">{{ $p->productVendor }} · {{ $p->productScale }}</p>
                <p class="mb-1 small">In Stock: <strong>{{ number_format($p->quantityInStock) }}</strong></p>
                <p class="fw-bold text-primary mb-0">${{ number_format($p->MSRP, 2) }}</p>
            </div>
            <div class="card-footer bg-transparent">
                <a href="{{ route('user.products.show', $p->productCode) }}" class="btn btn-sm btn-outline-primary w-100">View Details</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-5">No products found.</div>
    @endforelse
</div>
<div class="mt-3">{{ $products->appends(['search'=>$search,'line'=>$filterLine])->links() }}</div>
@endsection
