@extends('layouts.app')
@section('title', 'Edit Customer')
@section('nav_customers', 'active')

@section('content')
<div class="mb-3"><a href="{{ route('admin.customers.show', $customer->customerNumber) }}" class="btn btn-sm btn-outline-secondary">← Back</a></div>
<div class="card" style="max-width:700px;">
    <div class="card-header fw-semibold">Edit Customer #{{ $customer->customerNumber }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.customers.update', $customer->customerNumber) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Customer Name *</label>
                    <input type="text" name="customerName" class="form-control" value="{{ old('customerName', $customer->customerName) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">First Name *</label>
                    <input type="text" name="contactFirstName" class="form-control" value="{{ old('contactFirstName', $customer->contactFirstName) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name *</label>
                    <input type="text" name="contactLastName" class="form-control" value="{{ old('contactLastName', $customer->contactLastName) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone *</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address Line 1 *</label>
                    <input type="text" name="addressLine1" class="form-control" value="{{ old('addressLine1', $customer->addressLine1) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address Line 2</label>
                    <input type="text" name="addressLine2" class="form-control" value="{{ old('addressLine2', $customer->addressLine2) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">City *</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $customer->city) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $customer->state) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Postal Code</label>
                    <input type="text" name="postalCode" class="form-control" value="{{ old('postalCode', $customer->postalCode) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Country *</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $customer->country) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Credit Limit</label>
                    <input type="number" step="0.01" name="creditLimit" class="form-control" value="{{ old('creditLimit', $customer->creditLimit) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sales Rep</label>
                    <select name="salesRepEmployeeNumber" class="form-select">
                        <option value="">— None —</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->employeeNumber }}" {{ old('salesRepEmployeeNumber', $customer->salesRepEmployeeNumber) == $emp->employeeNumber ? 'selected' : '' }}>
                                {{ $emp->firstName }} {{ $emp->lastName }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Customer</button>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
