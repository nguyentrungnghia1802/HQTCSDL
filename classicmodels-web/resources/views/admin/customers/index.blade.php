@extends('layouts.app')
@section('title', 'Customers')
@section('nav_customers', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" class="d-flex gap-2">
        <input class="form-control" type="search" name="search" placeholder="Search name, city, country..." value="{{ $search }}">
        <button class="btn btn-outline-secondary">Search</button>
        @if($search)<a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">Clear</a>@endif
    </form>
    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New Customer</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th><th>Name</th><th>Contact</th><th>Phone</th><th>City</th><th>Country</th><th>Credit Limit</th><th>Sales Rep</th><th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $c)
                    <tr>
                        <td>{{ $c->customerNumber }}</td>
                        <td><strong>{{ $c->customerName }}</strong></td>
                        <td>{{ $c->contactFirstName }} {{ $c->contactLastName }}</td>
                        <td>{{ $c->phone }}</td>
                        <td>{{ $c->city }}</td>
                        <td>{{ $c->country }}</td>
                        <td>${{ number_format($c->creditLimit, 0) }}</td>
                        <td>{{ $c->salesRep ? $c->salesRep->firstName.' '.$c->salesRep->lastName : '—' }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.customers.show', $c->customerNumber) }}" class="btn btn-sm btn-outline-info">View</a>
                            <a href="{{ route('admin.customers.edit', $c->customerNumber) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form method="POST" action="{{ route('admin.customers.destroy', $c->customerNumber) }}" class="d-inline" onsubmit="return confirm('Delete this customer?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Del</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No customers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-3">{{ $customers->appends(['search'=>$search])->links() }}</div>
@endsection
