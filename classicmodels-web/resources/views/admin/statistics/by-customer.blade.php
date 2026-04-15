@extends('layouts.app')
@section('title', 'Statistics by Customer')
@section('nav_stat_c', 'active')

@section('content')
<div class="row g-3 mb-4">
    <!-- Bar chart: top 10 customers by revenue -->
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-header fw-semibold">Top 10 Customers by Revenue</div>
            <div class="card-body"><canvas id="customerChart" height="280"></canvas></div>
        </div>
    </div>
    <!-- Summary stats -->
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header fw-semibold">Summary</div>
            <div class="card-body">
                <p class="mb-1"><strong>Total Customers:</strong> {{ $customers->total() }}</p>
                <p class="mb-1"><strong>Total Revenue:</strong> ${{ number_format($customers->sum('payments_sum_amount'), 2) }}</p>
                <p class="mb-0"><strong>Total Orders:</strong> {{ $customers->sum('orders_count') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Customer × Year Pivot Table -->
<div class="card mb-4">
    <div class="card-header fw-semibold">Revenue by Customer × Year (Pivot Table)</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-sm mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Customer</th>
                        @foreach($years as $y)<th class="text-end">{{ $y }}</th>@endforeach
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $c)
                    <tr>
                        <td>{{ $c->customerName }}</td>
                        @foreach($years as $y)
                            <td class="text-end">
                                @php $val = $pivot[$c->customerNumber][$y] ?? 0; @endphp
                                {{ $val > 0 ? '$'.number_format($val, 0) : '—' }}
                            </td>
                        @endforeach
                        <th class="text-end fw-bold">${{ number_format($c->payments_sum_amount, 0) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th>Year Total</th>
                        @foreach($years as $y)
                    @php $yt = collect($pivot)->sum(fn($r) => $r[$y] ?? 0); @endphp
                        <th class="text-end">${{ number_format($yt, 0) }}</th>
                        @endforeach
                        <th class="text-end">${{ number_format($customers->sum('payments_sum_amount'), 0) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Detail Table -->
<div class="card">
    <div class="card-header fw-semibold">All Customers — Orders & Payments</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>#</th><th>Customer</th><th>Country</th><th>Orders</th><th>Total Payments</th></tr>
                </thead>
                <tbody>
                    @foreach($customers as $c)
                    <tr>
                        <td>{{ $c->customerNumber }}</td>
                        <td><a href="{{ route('admin.customers.show', $c->customerNumber) }}">{{ $c->customerName }}</a></td>
                        <td>{{ $c->country }}</td>
                        <td>{{ $c->orders_count }}</td>
                        <td>${{ number_format($c->payments_sum_amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const top10 = @json($customers->getCollection()->take(10)->values());
const labels = top10.map(c => c.customerName.substring(0, 20));
const data   = top10.map(c => parseFloat(c.payments_sum_amount ?? 0));

new Chart(document.getElementById('customerChart'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Total Payments ($)',
            data,
            backgroundColor: 'rgba(13,110,253,0.7)',
            borderColor: 'rgba(13,110,253,1)',
            borderWidth: 1
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true } }
    }
});
</script>
@endpush
