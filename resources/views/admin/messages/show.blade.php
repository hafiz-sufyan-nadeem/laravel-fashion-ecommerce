@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Message from: {{ $message->user->name }}</h3>
        <p><strong>Subject:</strong> {{ $message->subject }}</p>
        <p><strong>Message:</strong> {{ $message->message }}</p>

        <hr>
        <h4>Reply to User</h4>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
            @csrf
            <textarea name="reply" rows="5" class="form-control" placeholder="Write your reply..." required></textarea>
            <button type="submit" class="btn btn-success mt-2">Send Reply</button>
        </form>
    </div>
@endsection
