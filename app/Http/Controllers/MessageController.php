<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create()
    {
        return view('frontend.contacts.contact-admin');
    }

    public function store(Request $request){
        $request->validate([
           'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'is_admin' => 1,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully');
    }
}
