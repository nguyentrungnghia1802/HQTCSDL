<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Customer, Order, Payment, Product, Orderdetail};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    // Thống kê theo khách hàng
    public function byCustomer(Request $request)
    {
        $customers = Customer::withCount('orders')
            ->withSum('payments', 'amount')
            ->orderByDesc('payments_sum_amount')
            ->paginate(20);

        // Distinct years from payments
        $years = DB::table('payments')
            ->select(DB::raw('YEAR(paymentDate) as year'))
            ->distinct()
            ->orderBy('year')
            ->pluck('year');

        // Pivot: revenue per customer per year, keyed by customerNumber
        $pivotRaw = DB::table('payments')
            ->select(
                'customerNumber',
                DB::raw('YEAR(paymentDate) as year'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('customerNumber', 'year')
            ->get();

        $pivot = [];
        foreach ($pivotRaw as $row) {
            $pivot[$row->customerNumber][$row->year] = $row->total;
        }

        return view('admin.statistics.by-customer', compact('customers', 'pivot', 'years'));
    }

    // Thống kê theo thời gian
    public function byTime(Request $request)
    {
        $defaultYear = DB::table('orders')
            ->selectRaw('MAX(YEAR(orderDate)) as y')
            ->value('y') ?? date('Y');
        $year = (int) $request->get('year', $defaultYear);

        $monthly = DB::table('orders')
            ->join('orderdetails', 'orders.orderNumber', '=', 'orderdetails.orderNumber')
            ->select(
                DB::raw('MONTH(orders.orderDate) as month'),
                DB::raw('YEAR(orders.orderDate) as year'),
                DB::raw('SUM(orderdetails.quantityOrdered * orderdetails.priceEach) as revenue'),
                DB::raw('COUNT(DISTINCT orders.orderNumber) as order_count')
            )
            ->whereYear('orders.orderDate', $year)
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get();

        $years = DB::table('orders')
            ->select(DB::raw('YEAR(orderDate) as year'))
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('admin.statistics.by-time', compact('monthly', 'year', 'years'));
    }

    // Thống kê theo mặt hàng
    public function byProduct(Request $request)
    {
        $products = DB::table('products')
            ->join('orderdetails', 'products.productCode', '=', 'orderdetails.productCode')
            ->join('productlines', 'products.productLine', '=', 'productlines.productLine')
            ->select(
                'products.productCode',
                'products.productName',
                'products.productLine',
                DB::raw('SUM(orderdetails.quantityOrdered) as total_qty'),
                DB::raw('SUM(orderdetails.quantityOrdered * orderdetails.priceEach) as total_revenue'),
                DB::raw('COUNT(DISTINCT orderdetails.orderNumber) as order_count')
            )
            ->groupBy('products.productCode', 'products.productName', 'products.productLine')
            ->orderByDesc('total_revenue')
            ->get();

        // Grouped by product line
        $byLine = $products->groupBy('productLine')->map(function ($items) {
            return [
                'count'   => $items->count(),
                'revenue' => $items->sum('total_revenue'),
                'qty'     => $items->sum('total_qty'),
            ];
        });

        return view('admin.statistics.by-product', compact('products', 'byLine'));
    }
}
