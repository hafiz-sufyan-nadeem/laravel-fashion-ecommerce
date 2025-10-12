<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $currentMonth = now()->month;
        $currentYear = now()->year;

//        ONLY DELIVERED ORDERS COUNT.
        $earningsMonthly = Order::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('status', 'delivered')
            ->sum('total_amount');

//        TOTAL SALES COUNT
        $totalSales = Order::where('status', 'delivered')->count();

//        TOTAL CUSTOMERS
        $totalCustomers = User::count();

//        TOTAL PENDING ORDERS
        $pendingOrders= Order::where('status', 'pending')->count();

        return view('admin.layouts.dashboard', compact(
            'earningsMonthly',
            'totalSales',
            'totalCustomers',
            'pendingOrders'
        ));
    }
}
