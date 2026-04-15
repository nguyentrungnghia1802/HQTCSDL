@extends('layouts.app')
@section('title', 'Products')
@section('nav_products', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" class="d-flex gap-2 flex-wrap">
        <input class="form-control" type="search" name="search" placeholder="Search name, vendor..." value="{{ $search }}" style="width:220px;">
        <select name="line" class="form-select" style="width:180px;">
            <option value="">All Lines</option>
            @foreach($lines as $pl)
                <option value="{{ $pl }}" {{ $filterLine == $pl ? 'selected' : '' }}>{{ $pl }}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-secondary">Filter</button>
        @if($search || $filterLine)<a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Clear</a>@endif
    </form>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New Product</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>Code</th><th>Name</th><th>Line</th><th>Scale</th><th>Vendor</th><th>In Stock</th><th>MSRP</th><th>Buy Price</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($products as $p)
                    <tr>
                        <td><code>{{ $p->productCode }}</code></td>
                        <td><strong>{{ $p->productName }}</strong></td>
                        <td><span class="badge bg-secondary">{{ $p->productLine }}</span></td>
                        <td>{{ $p->productScale }}</td>
                        <td>{{ $p->productVendor }}</td>
                        <td>{{ number_format($p->quantityInStock) }}</td>
                        <td>${{ number_format($p->MSRP, 2) }}</td>
                        <td>${{ number_format($p->buyPrice, 2) }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.products.show', $p->productCode) }}" class="btn btn-sm btn-outline-info">View</a>
                            <a href="{{ route('admin.products.edit', $p->productCode) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $p->productCode) }}" class="d-inline" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Del</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No products found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-3">{{ $products->appends(['search'=>$search,'line'=>$filterLine])->links() }}</div>
@endsection
