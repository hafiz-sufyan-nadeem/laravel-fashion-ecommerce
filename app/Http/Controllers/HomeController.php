<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function home(Request $request)
    {
        $products = Product::latest()->get();

        return view('frontend.layouts.home', compact('products'));
    }
}
