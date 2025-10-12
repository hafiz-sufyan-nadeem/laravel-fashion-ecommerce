<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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

        return view('admin.layouts.dashboard', compact( 'earningsMonthly', 'totalSales'));
    }
}
