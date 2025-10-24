
    <div class="container mt-4">
        <h3>Your Messages</h3>

        @forelse($messages as $msg)
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>Subject:</strong> {{ $msg->subject }}</p>
                    <p><strong>Your Message:</strong> {{ $msg->message }}</p>

                    @if($msg->replies->count() > 0)
                        <hr>
                        <h5>Replies:</h5>
                        @foreach($msg->replies as $reply)
                            <div class="alert alert-info">
                                <strong>Admin:</strong> {{ $reply->message }}
                                <div class="text-muted small">{{ $reply->created_at->diffForHumans() }}</div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No reply yet.</p>
                    @endif
                </div>
            </div>
        @empty
            <p>You haven't sent any messages yet.</p>
        @endforelse
    </div>

