@extends('layouts.app')
@section('title', 'Statistics by Product')
@section('nav_stat_p', 'active')

@section('content')
<div class="row g-3 mb-4">
    <!-- Top 10 products bar chart -->
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-header fw-semibold">Top 10 Products by Revenue</div>
            <div class="card-body"><canvas id="productChart" height="300"></canvas></div>
        </div>
    </div>
    <!-- Product line doughnut chart -->
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header fw-semibold">Revenue by Product Line</div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="lineChart" style="max-height:280px;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- By Product Line grouped summary -->
<div class="card mb-4">
    <div class="card-header fw-semibold">Summary by Product Line</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-sm mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Product Line</th>
                        <th class="text-end">Products</th>
                        <th class="text-end">Qty Sold</th>
                        <th class="text-end">Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($byLine as $line => $group)
                    <tr>
                        <td><strong>{{ $line }}</strong></td>
                        <td class="text-end">{{ $group['count'] }}</td>
                        <td class="text-end">{{ number_format($group['qty']) }}</td>
                        <td class="text-end">${{ number_format($group['revenue'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th>Total</th>
                        <th class="text-end">{{ $products->count() }}</th>
                        <th class="text-end">{{ number_format($products->sum('total_qty')) }}</th>
                        <th class="text-end">${{ number_format($products->sum('total_revenue'), 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- All products table -->
<div class="card">
    <div class="card-header fw-semibold">All Products — Sales Ranking</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>Rank</th><th>Code</th><th>Name</th><th>Line</th><th>Qty Sold</th><th>Revenue</th><th>Orders</th></tr>
                </thead>
                <tbody>
                    @foreach($products as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><code>{{ $p->productCode }}</code></td>
                        <td>{{ $p->productName }}</td>
                        <td><span class="badge bg-secondary">{{ $p->productLine }}</span></td>
                        <td>{{ number_format($p->total_qty) }}</td>
                        <td>${{ number_format($p->total_revenue, 2) }}</td>
                        <td>{{ $p->order_count }}</td>
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
const products = @json($products->take(10)->values());
const pLabels  = products.map(p => p.productName.substring(0, 25));
const pRevData = products.map(p => parseFloat(p.total_revenue));

new Chart(document.getElementById('productChart'), {
    type: 'bar',
    data: {
        labels: pLabels,
        datasets: [{
            label: 'Revenue ($)',
            data: pRevData,
            backgroundColor: [
                '#0d6efd','#6610f2','#6f42c1','#d63384','#dc3545',
                '#fd7e14','#ffc107','#198754','#20c997','#0dcaf0'
            ],
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true } }
    }
});

// By Line doughnut
const byLineRaw = @json($byLine);
const lineLabels = Object.keys(byLineRaw);
const lineData   = lineLabels.map(k => parseFloat(byLineRaw[k].revenue));
const lineColors = ['#0d6efd','#6f42c1','#d63384','#dc3545','#fd7e14','#ffc107','#198754'];

new Chart(document.getElementById('lineChart'), {
    type: 'doughnut',
    data: {
        labels: lineLabels,
        datasets: [{ data: lineData, backgroundColor: lineColors }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
    }
});
</script>
@endpush
