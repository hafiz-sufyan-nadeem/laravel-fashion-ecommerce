<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminCustomerController extends Controller
{
    public function index(){
        $customers = User::all();

        return view('admin.customers.index', compact('customers'));
    }
}
