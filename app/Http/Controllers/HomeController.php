<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function home(Request $request)
    {
        $fashionProducts = Product::where('category_id', 1)->latest()->get();
        $electronicProducts = Product::where('category_id', 2)->latest()->get();
        $jewelleryProducts = Product::where('category_id', 3)->latest()->get();

        return view('frontend.layouts.home',
            compact('fashionProducts', 'electronicProducts', 'jewelleryProducts'));
    }
}
