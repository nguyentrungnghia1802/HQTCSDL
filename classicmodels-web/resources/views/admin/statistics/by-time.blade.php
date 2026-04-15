@extends('layouts.app')
@section('title', 'Statistics by Time')
@section('nav_stat_t', 'active')

@section('content')
<!-- Year filter -->
<div class="mb-3">
    @php $currentYear = $year; @endphp
    <form method="GET" class="d-inline-flex gap-2 align-items-center">
        <label class="fw-semibold mb-0">Year:</label>
        <select name="year" class="form-select form-select-sm" style="width:100px;" onchange="this.form.submit()">
            @foreach($years as $y)
                <option value="{{ $y }}" {{ $currentYear == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
    </form>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header fw-semibold">Monthly Revenue — {{ $currentYear }}</div>
            <div class="card-body"><canvas id="timeChart" height="220"></canvas></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header fw-semibold">Annual Summary</div>
            <div class="card-body">
                <p><strong>Year:</strong> {{ $currentYear }}</p>
                <p><strong>Total Revenue:</strong> ${{ number_format(collect($monthly)->sum('revenue'), 2) }}</p>
                <p><strong>Total Orders:</strong> {{ collect($monthly)->sum('order_count') }}</p>
                <p class="mb-0"><strong>Active Months:</strong> {{ collect($monthly)->where('order_count', '>', 0)->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Monthly Detail Table -->
<div class="card">
    <div class="card-header fw-semibold">Monthly Breakdown</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Month</th>
                        <th class="text-end">Orders</th>
                        <th class="text-end">Revenue</th>
                        <th>Revenue Bar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                        $maxRev = collect($monthly)->max('revenue') ?: 1;
                    @endphp
                    @foreach($monthly as $row)
                    <tr>
                        <td>{{ $months[$row->month-1] ?? 'M'.$row->month }}</td>
                        <td class="text-end">{{ $row->order_count }}</td>
                        <td class="text-end">${{ number_format($row->revenue, 2) }}</td>
                        <td style="width:200px;">
                            <div class="progress" style="height:16px;">
                                <div class="progress-bar bg-info" style="width:{{ round($row->revenue/$maxRev*100) }}%"></div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th>Total</th>
                        <th class="text-end">{{ collect($monthly)->sum('order_count') }}</th>
                        <th class="text-end">${{ number_format(collect($monthly)->sum('revenue'), 2) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
const raw = @json($monthly);

// Fill all 12 months (some may be missing)
const revenueData = Array(12).fill(0);
const orderData   = Array(12).fill(0);
raw.forEach(r => {
    revenueData[r.month - 1] = parseFloat(r.revenue);
    orderData[r.month - 1]   = parseInt(r.order_count);
});

new Chart(document.getElementById('timeChart'), {
    type: 'line',
    data: {
        labels: months,
        datasets: [
            {
                label: 'Revenue ($)',
                data: revenueData,
                borderColor: 'rgba(13,110,253,1)',
                backgroundColor: 'rgba(13,110,253,0.1)',
                fill: true,
                tension: 0.3,
                yAxisID: 'y'
            },
            {
                label: 'Orders',
                data: orderData,
                borderColor: 'rgba(220,53,69,1)',
                backgroundColor: 'rgba(220,53,69,0.1)',
                fill: false,
                tension: 0.3,
                yAxisID: 'y1'
            }
        ]
    },
    options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        scales: {
            y:  { beginAtZero: true, position: 'left', title: { display: true, text: 'Revenue ($)' } },
            y1: { beginAtZero: true, position: 'right', grid: { drawOnChartArea: false }, title: { display: true, text: 'Orders' } }
        }
    }
});
</script>
@endpush
