<style>
    body {
        background-color: #f9fafb;
        font-family: "Poppins", sans-serif;
    }

    .message-box {
        max-width: 520px;
        margin: 60px auto;
        background: #ffffff;
        padding: 35px 40px;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    .message-box h2 {
        text-align: center;
        color: #333;
        font-weight: 600;
        margin-bottom: 25px;
        font-size: 24px;
    }

    .form-label {
        font-weight: 500;
        color: #444;
        margin-bottom: 8px;
        font-size: 15px;
    }

    .form-control {
        width: 100%;
        border: 1px solid #dcdcdc;
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 15px;
        outline: none;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #8aaae5;
        box-shadow: 0 0 6px rgba(138, 170, 229, 0.3);
    }

    .btn-send {
        width: 100%;
        background: #8aaae5;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 500;
        font-size: 15px;
        transition: 0.2s;
        margin-top: 12px;
    }

    .btn-send:hover {
        background: #7796db;
        transform: translateY(-1px);
    }

    .alert {
        text-align: center;
        border-radius: 8px;
        font-weight: 500;
        font-size: 14px;
        padding: 10px;
        margin-bottom: 15px;
    }

    .form-group {
        margin-bottom: 20px;
    }
</style>



<div class="message-box">
    <h2>Message Admin</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.admin.store') }}">
        @csrf

        <div class="form-group">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter subject" required>
        </div>

        <div class="form-group">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" rows="4" class="form-control" placeholder="Write your message..." required></textarea>
        </div>

        <button type="submit" class="btn-send">Send Message</button>
    </form>

</div>
