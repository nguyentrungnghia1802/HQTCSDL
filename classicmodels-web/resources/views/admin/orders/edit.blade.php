@extends('layouts.app')
@section('title', 'Edit Order #'.$order->orderNumber)
@section('nav_orders', 'active')

@section('content')
<div class="mb-3"><a href="{{ route('admin.orders.show', $order->orderNumber) }}" class="btn btn-sm btn-outline-secondary">← Back</a></div>
<div class="card" style="max-width:500px;">
    <div class="card-header fw-semibold">Update Order #{{ $order->orderNumber }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.orders.update', $order->orderNumber) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    @foreach(['In Process','Shipped','Resolved','Cancelled','On Hold','Disputed'] as $s)
                        <option value="{{ $s }}" {{ old('status', $order->status) == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Shipped Date</label>
                <input type="date" name="shippedDate" class="form-control" value="{{ old('shippedDate', $order->shippedDate) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Comments</label>
                <textarea name="comments" class="form-control" rows="3">{{ old('comments', $order->comments) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Order</button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
</div>
@endsection
