<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index(){
        return view('admin.customers.index');
    }
}
