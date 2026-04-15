<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ClassicModels - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: #1a1a2e; color: #eee; }
        .sidebar .nav-link { color: #ccc; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.1); border-radius: 6px; }
        .sidebar .brand { color: #fff; font-weight: 700; font-size: 1.2rem; }
        .content-wrapper { padding: 1.5rem; }
        .card { border: none; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        .stat-card { border-radius: 12px; }
        .badge-admin { background: #dc3545; }
        .badge-user { background: #0d6efd; }
    </style>
    @stack('styles')
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar py-3 px-3">
            <div class="brand mb-4">
                <i class="bi bi-car-front-fill"></i> ClassicModels
            </div>
            <nav class="nav flex-column gap-1">
                @if(auth()->user()->role === 'admin')
                    <a class="nav-link @yield('nav_dashboard')" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <div class="text-uppercase text-muted small px-2 mt-3 mb-1" style="font-size:.7rem;">Management</div>
                    <a class="nav-link @yield('nav_customers')" href="{{ route('admin.customers.index') }}">
                        <i class="bi bi-people"></i> Customers
                    </a>
                    <a class="nav-link @yield('nav_products')" href="{{ route('admin.products.index') }}">
                        <i class="bi bi-box-seam"></i> Products
                    </a>
                    <a class="nav-link @yield('nav_orders')" href="{{ route('admin.orders.index') }}">
                        <i class="bi bi-receipt"></i> Orders
                    </a>
                    <a class="nav-link @yield('nav_employees')" href="{{ route('admin.employees.index') }}">
                        <i class="bi bi-person-badge"></i> Employees
                    </a>
                    <div class="text-uppercase text-muted small px-2 mt-3 mb-1" style="font-size:.7rem;">Statistics</div>
                    <a class="nav-link @yield('nav_stat_c')" href="{{ route('admin.statistics.customers') }}">
                        <i class="bi bi-bar-chart"></i> By Customer
                    </a>
                    <a class="nav-link @yield('nav_stat_t')" href="{{ route('admin.statistics.time') }}">
                        <i class="bi bi-calendar-range"></i> By Time
                    </a>
                    <a class="nav-link @yield('nav_stat_p')" href="{{ route('admin.statistics.products') }}">
                        <i class="bi bi-pie-chart"></i> By Product
                    </a>
                @else
                    <a class="nav-link @yield('nav_dashboard')" href="{{ route('user.dashboard') }}">
                        <i class="bi bi-house"></i> Home
                    </a>
                    <a class="nav-link @yield('nav_products')" href="{{ route('user.products.index') }}">
                        <i class="bi bi-box-seam"></i> Products
                    </a>
                    <a class="nav-link @yield('nav_orders')" href="{{ route('user.orders.index') }}">
                        <i class="bi bi-receipt"></i> Orders
                    </a>
                @endif
                <div class="text-uppercase text-muted small px-2 mt-3 mb-1" style="font-size:.7rem;">Tools</div>
                <a class="nav-link" href="{{ route('search') }}">
                    <i class="bi bi-search"></i> Search
                </a>
                <a class="nav-link" href="{{ route('chatbot.index') }}">
                    <i class="bi bi-chat-dots"></i> Chatbot
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <!-- Top Navbar -->
            <nav class="navbar navbar-light bg-white border-bottom px-3">
                <span class="navbar-brand fw-bold">@yield('title', 'Dashboard')</span>
                <div class="d-flex align-items-center gap-3">
                    <form action="{{ route('search') }}" method="GET" class="d-flex">
                        <input class="form-control form-control-sm me-2" type="search" name="q" placeholder="Search..." value="{{ request('q') }}">
                        <button class="btn btn-sm btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            {{ auth()->user()->name }}
                            <span class="badge ms-1 {{ auth()->user()->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                                {{ auth()->user()->role }}
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
