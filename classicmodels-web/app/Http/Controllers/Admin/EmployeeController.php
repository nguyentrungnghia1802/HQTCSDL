<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Office;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with('office');
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('firstName', 'like', "%$s%")
                  ->orWhere('lastName', 'like', "%$s%")
                  ->orWhere('jobTitle', 'like', "%$s%");
        }
        $employees = $query->orderBy('lastName')->paginate(15)->withQueryString();
        $search = $request->get('search', '');
        return view('admin.employees.index', compact('employees', 'search'));
    }

    public function show(Employee $employee)
    {
        $employee->load('office', 'manager', 'subordinates', 'customers');
        return view('admin.employees.show', compact('employee'));
    }
}
