<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('customerName', 'like', "%$s%")
                  ->orWhere('country', 'like', "%$s%");
        }
        return CustomerResource::collection($query->paginate(20));
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer->load('orders', 'payments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customerNumber'  => 'required|integer|unique:customers',
            'customerName'    => 'required|string|max:50',
            'contactLastName' => 'required|string|max:50',
            'contactFirstName'=> 'required|string|max:50',
            'phone'           => 'required|string|max:50',
            'addressLine1'    => 'required|string|max:50',
            'city'            => 'required|string|max:50',
            'country'         => 'required|string|max:50',
        ]);
        return new CustomerResource(Customer::create($data));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
