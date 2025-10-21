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
            'is_read' => false,
        ]);

        return redirect()->route('contact.admin')->with('success', 'Message sent successfully');
    }

    public function index()
    {
        $messages = Message::with('user')->latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::with('user')->findOrFail($id);
        $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }


    public function reply(Request $request, $id)
    {
        $request->validate(['reply' => 'required|string']);

        $message = Message::findOrFail($id);

        Message::create([
            'user_id' => $message->user_id,
            'admin_id' => auth()->id(),
            'message' => $request->input('reply'),
            'parent_id' => $id,
            'is_read' => 0,
        ]);

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }



}
