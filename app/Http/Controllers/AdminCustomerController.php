<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class AdminCustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();

        return view('admin.customers.index', compact('customers'));
    }
}
