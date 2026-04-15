@extends('layouts.app')
@section('title', 'Customer: '.$customer->customerName)
@section('nav_customers', 'active')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <a href="{{ route('admin.customers.edit', $customer->customerNumber) }}" class="btn btn-sm btn-warning ms-2">Edit</a>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header fw-semibold">Customer Details</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr><th>ID</th><td>{{ $customer->customerNumber }}</td></tr>
                    <tr><th>Name</th><td>{{ $customer->customerName }}</td></tr>
                    <tr><th>Contact</th><td>{{ $customer->contactFirstName }} {{ $customer->contactLastName }}</td></tr>
                    <tr><th>Phone</th><td>{{ $customer->phone }}</td></tr>
                    <tr><th>Address</th><td>{{ $customer->addressLine1 }}{{ $customer->addressLine2 ? ', '.$customer->addressLine2 : '' }}</td></tr>
                    <tr><th>City</th><td>{{ $customer->city }}</td></tr>
                    <tr><th>State</th><td>{{ $customer->state }}</td></tr>
                    <tr><th>Postal</th><td>{{ $customer->postalCode }}</td></tr>
                    <tr><th>Country</th><td>{{ $customer->country }}</td></tr>
                    <tr><th>Credit Limit</th><td>${{ number_format($customer->creditLimit, 2) }}</td></tr>
                    <tr><th>Sales Rep</th><td>{{ $customer->salesRep ? $customer->salesRep->firstName.' '.$customer->salesRep->lastName : '—' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header fw-semibold">Orders ({{ $customer->orders->count() }})</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr><th>#</th><th>Date</th><th>Status</th><th>Total</th><th></th></tr>
                        </thead>
                        <tbody>
                            @forelse($customer->orders as $o)
                            <tr>
                                <td>{{ $o->orderNumber }}</td>
                                <td>{{ $o->orderDate }}</td>
                                <td><span class="badge bg-secondary">{{ $o->status }}</span></td>
                                <td>${{ number_format($o->orderDetails->sum(fn($d) => $d->quantityOrdered * $d->priceEach), 2) }}</td>
                                <td><a href="{{ route('admin.orders.show', $o->orderNumber) }}" class="btn btn-sm btn-outline-secondary">View</a></td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-muted text-center py-2">No orders.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header fw-semibold">Payments ({{ $customer->payments->count() }})</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr><th>Check No</th><th>Payment Date</th><th>Amount</th></tr>
                        </thead>
                        <tbody>
                            @forelse($customer->payments as $p)
                            <tr>
                                <td>{{ $p->checkNumber }}</td>
                                <td>{{ $p->paymentDate }}</td>
                                <td>${{ number_format($p->amount, 2) }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-muted text-center py-2">No payments.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
