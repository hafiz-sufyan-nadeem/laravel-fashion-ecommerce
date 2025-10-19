 <div class="container py-5">
        <h2 class="mb-4">Message Admin</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('contact.admin.store') }}">
            @csrf
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" rows="5" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

