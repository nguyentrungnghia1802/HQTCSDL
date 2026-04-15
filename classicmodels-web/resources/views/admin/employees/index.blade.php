@extends('layouts.app')
@section('title', 'Employees')
@section('nav_employees', 'active')

@section('content')
<div class="mb-3">
    <form method="GET" class="d-flex gap-2">
        <input class="form-control" type="search" name="search" placeholder="Search name, title, email..." value="{{ $search }}" style="width:280px;">
        <button class="btn btn-outline-secondary">Search</button>
        @if($search)<a href="{{ route('admin.employees.index') }}" class="btn btn-outline-secondary">Clear</a>@endif
    </form>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>#</th><th>Name</th><th>Title</th><th>Email</th><th>Office</th><th>Extension</th><th>Reports To</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($employees as $e)
                    <tr>
                        <td>{{ $e->employeeNumber }}</td>
                        <td><strong>{{ $e->firstName }} {{ $e->lastName }}</strong></td>
                        <td>{{ $e->jobTitle }}</td>
                        <td>{{ $e->email }}</td>
                        <td>{{ $e->office->city ?? '—' }}</td>
                        <td>{{ $e->extension }}</td>
                        <td>{{ $e->manager ? $e->manager->firstName.' '.$e->manager->lastName : '—' }}</td>
                        <td><a href="{{ route('admin.employees.show', $e->employeeNumber) }}" class="btn btn-sm btn-outline-info">View</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No employees found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-3">{{ $employees->appends(['search'=>$search])->links() }}</div>
@endsection
