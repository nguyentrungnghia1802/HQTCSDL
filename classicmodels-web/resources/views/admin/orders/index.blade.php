@extends('layouts.app')
@section('title', 'Orders')
@section('nav_orders', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" class="d-flex gap-2 flex-wrap">
        <input class="form-control" type="search" name="search" placeholder="Search order#, customer..." value="{{ $search }}" style="width:220px;">
        <select name="status" class="form-select" style="width:160px;">
            <option value="">All Statuses</option>
            @foreach(['In Process','Shipped','Resolved','Cancelled','On Hold','Disputed'] as $s)
                <option value="{{ $s }}" {{ $filterStatus == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-secondary">Filter</button>
        @if($search || $filterStatus)<a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Clear</a>@endif
    </form>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>#</th><th>Customer</th><th>Order Date</th><th>Required Date</th><th>Shipped Date</th><th>Status</th><th>Total</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($orders as $o)
                    @php
                        $total = $o->orderDetails->sum(fn($d) => $d->quantityOrdered * $d->priceEach);
                        $badges = ['Shipped'=>'success','In Process'=>'warning','Resolved'=>'info','Cancelled'=>'danger','On Hold'=>'secondary','Disputed'=>'dark'];
                        $badge = $badges[$o->status] ?? 'secondary';
                    @endphp
                    <tr>
                        <td><strong>{{ $o->orderNumber }}</strong></td>
                        <td>{{ $o->customer->customerName ?? '—' }}</td>
                        <td>{{ $o->orderDate }}</td>
                        <td>{{ $o->requiredDate }}</td>
                        <td>{{ $o->shippedDate ?? '—' }}</td>
                        <td><span class="badge bg-{{ $badge }}">{{ $o->status }}</span></td>
                        <td>${{ number_format($total, 2) }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $o->orderNumber) }}" class="btn btn-sm btn-outline-info">View</a>
                            <a href="{{ route('admin.orders.edit', $o->orderNumber) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No orders found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-3">{{ $orders->appends(['search'=>$search,'status'=>$filterStatus])->links() }}</div>
@endsection
