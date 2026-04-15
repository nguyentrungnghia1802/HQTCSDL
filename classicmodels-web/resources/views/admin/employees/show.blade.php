@extends('layouts.app')
@section('title', $employee->firstName.' '.$employee->lastName)
@section('nav_employees', 'active')

@section('content')
<div class="mb-3"><a href="{{ route('admin.employees.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a></div>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header fw-semibold">Employee Details</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr><th>ID</th><td>{{ $employee->employeeNumber }}</td></tr>
                    <tr><th>Name</th><td>{{ $employee->firstName }} {{ $employee->lastName }}</td></tr>
                    <tr><th>Title</th><td>{{ $employee->jobTitle }}</td></tr>
                    <tr><th>Email</th><td>{{ $employee->email }}</td></tr>
                    <tr><th>Extension</th><td>{{ $employee->extension }}</td></tr>
                    <tr><th>Office</th><td>{{ $employee->office ? $employee->office->city.', '.$employee->office->country : '—' }}</td></tr>
                    <tr><th>Reports To</th><td>{{ $employee->manager ? $employee->manager->firstName.' '.$employee->manager->lastName : '— (Top)' }}</td></tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header fw-semibold">Subordinates ({{ $employee->subordinates->count() }})</div>
            <ul class="list-group list-group-flush">
                @forelse($employee->subordinates as $sub)
                    <li class="list-group-item">
                        <a href="{{ route('admin.employees.show', $sub->employeeNumber) }}">{{ $sub->firstName }} {{ $sub->lastName }}</a>
                        <small class="text-muted d-block">{{ $sub->jobTitle }}</small>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No subordinates</li>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header fw-semibold">Assigned Customers ({{ $employee->customers->count() }})</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr><th>#</th><th>Name</th><th>City</th><th>Country</th><th>Credit Limit</th></tr>
                        </thead>
                        <tbody>
                            @forelse($employee->customers as $c)
                            <tr>
                                <td>{{ $c->customerNumber }}</td>
                                <td><a href="{{ route('admin.customers.show', $c->customerNumber) }}">{{ $c->customerName }}</a></td>
                                <td>{{ $c->city }}</td>
                                <td>{{ $c->country }}</td>
                                <td>${{ number_format($c->creditLimit, 0) }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-muted text-center py-2">No customers assigned.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
