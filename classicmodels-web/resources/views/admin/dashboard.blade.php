@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('nav_dashboard', 'active')

@section('content')
<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-2">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body">
                <div class="small opacity-75">Customers</div>
                <div class="fs-3 fw-bold">{{ $stats['total_customers'] }}</div>
                <i class="bi bi-people fs-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card stat-card bg-success text-white">
            <div class="card-body">
                <div class="small opacity-75">Orders</div>
                <div class="fs-3 fw-bold">{{ $stats['total_orders'] }}</div>
                <i class="bi bi-receipt fs-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card stat-card bg-warning text-dark">
            <div class="card-body">
                <div class="small opacity-75">Products</div>
                <div class="fs-3 fw-bold">{{ $stats['total_products'] }}</div>
                <i class="bi bi-box-seam fs-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-info text-white">
            <div class="card-body">
                <div class="small opacity-75">Total Revenue</div>
                <div class="fs-4 fw-bold">${{ number_format($stats['total_revenue'], 0) }}</div>
                <i class="bi bi-cash-stack fs-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-danger text-white">
            <div class="card-body">
                <div class="small opacity-75">Pending Orders</div>
                <div class="fs-3 fw-bold">{{ $stats['pending_orders'] }}</div>
                <i class="bi bi-clock-history fs-4 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Recent Orders</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#Order</th>
                        <th>Customer</th>
                        <th>Order Date</th>
                        <th>Required Date</th>
                        <th>Status</th>
                        <th>Comments</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    <tr>
                        <td><strong>{{ $order->orderNumber }}</strong></td>
                        <td>{{ $order->customer->customerName ?? 'N/A' }}</td>
                        <td>{{ $order->orderDate }}</td>
                        <td>{{ $order->requiredDate }}</td>
                        <td>
                            @php
                                $badges = ['Shipped'=>'success','In Process'=>'warning','Resolved'=>'info','Cancelled'=>'danger','On Hold'=>'secondary','Disputed'=>'dark'];
                                $badge = $badges[$order->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $order->status }}</span>
                        </td>
                        <td class="text-truncate" style="max-width:150px;">{{ $order->comments }}</td>
                        <td><a href="{{ route('admin.orders.show', $order->orderNumber) }}" class="btn btn-sm btn-outline-secondary">View</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No orders found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
