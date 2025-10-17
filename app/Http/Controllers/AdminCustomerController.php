<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

    public function show($id)
    {
        $user = User::findOrFail($id);
        $orders = Order::where('user_id',$id)->with('orderItems.product')->get();

        return view('admin.customers.show', compact('user', 'orders'));
    }
}
