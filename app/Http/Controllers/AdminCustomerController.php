<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminCustomerController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $customers = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(5);

        return view('admin.customers.index', compact('customers', 'search'));
    }
}
