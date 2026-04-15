<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::with('salesRep');
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('customerName', 'like', "%$s%")
                  ->orWhere('contactLastName', 'like', "%$s%")
                  ->orWhere('city', 'like', "%$s%")
                  ->orWhere('country', 'like', "%$s%");
            });
        }
        $customers = $query->orderBy('customerName')->paginate(15)->withQueryString();
        $search = $request->get('search', '');
        return view('admin.customers.index', compact('customers', 'search'));
    }

    public function show(Customer $customer)
    {
        $customer->load('orders.orderDetails.product', 'payments', 'salesRep');
        return view('admin.customers.show', compact('customer'));
    }

    public function create()
    {
        $employees = Employee::where('jobTitle', 'like', '%Sales Rep%')->get();
        return view('admin.customers.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customerNumber'          => 'required|integer|unique:customers',
            'customerName'            => 'required|string|max:50',
            'contactLastName'         => 'required|string|max:50',
            'contactFirstName'        => 'required|string|max:50',
            'phone'                   => 'required|string|max:50',
            'addressLine1'            => 'required|string|max:50',
            'city'                    => 'required|string|max:50',
            'country'                 => 'required|string|max:50',
            'creditLimit'             => 'nullable|numeric',
            'salesRepEmployeeNumber'  => 'nullable|integer|exists:employees,employeeNumber',
        ]);
        Customer::create($data);
        return redirect()->route('admin.customers.index')->with('success', 'Customer created.');
    }

    public function edit(Customer $customer)
    {
        $employees = Employee::where('jobTitle', 'like', '%Sales Rep%')->get();
        return view('admin.customers.edit', compact('customer', 'employees'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'customerName'           => 'required|string|max:50',
            'contactLastName'        => 'required|string|max:50',
            'contactFirstName'       => 'required|string|max:50',
            'phone'                  => 'required|string|max:50',
            'addressLine1'           => 'required|string|max:50',
            'city'                   => 'required|string|max:50',
            'country'                => 'required|string|max:50',
            'creditLimit'            => 'nullable|numeric',
            'salesRepEmployeeNumber' => 'nullable|integer|exists:employees,employeeNumber',
        ]);
        $customer->update($data);
        return redirect()->route('admin.customers.index')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted.');
    }
}
