@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>User Messages</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($messages as $msg)
                <tr>
                    <td>{{ $msg->id }}</td>
                    <td>{{ $msg->user->name }}</td>
                    <td>{{ $msg->subject }}</td>
                    <td>{{ Str::limit($msg->message, 50) }}</td>
                    <td>
                        @if($msg->is_read)
                            <span class="badge bg-success">Read</span>
                        @else
                            <span class="badge bg-danger">Unread</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $messages->links() }}
    </div>
@endsection
