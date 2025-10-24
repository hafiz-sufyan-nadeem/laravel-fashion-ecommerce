<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid bg-dark py-2">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
        <ul class="d-flex align-items-center gap-4 mb-0" style="list-style: none; padding: 0;">
            <li><a href="#" class="text-white text-decoration-none">Best Sellers</a></li>
            <li><a href="#" class="text-white text-decoration-none">Gift Ideas</a></li>
            <li><a href="#" class="text-white text-decoration-none">New Releases</a></li>
            <li><a href="#" class="text-white text-decoration-none">Today's Deals</a></li>
            <li><a href="{{ route('contact.admin') }}" class="fw-bold text-white text-decoration-none">Message Admin</a></li>
        </ul>

        {{-- Chat Icon Dropdown --}}
        <div class="dropdown">
            <button class="btn btn-dark border-0 position-relative" type="button" id="messagesDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-chat-dots fs-5 text-white"></i>
                @if(!empty($userUnreadRepliesCount) && $userUnreadRepliesCount > 0)
                    <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">
                        {{ $userUnreadRepliesCount }}
                    </span>
                @endif
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2"
                aria-labelledby="messagesDropdown" style="width: 280px;">
                <li class="dropdown-header fw-bold text-center bg-dark text-white rounded-top py-2">
                    Your Replies
                </li>
                <li><hr class="dropdown-divider"></li>

                @forelse($userRecentReplies ?? [] as $reply)
                    <li>
                        <a class="dropdown-item small" href="#">
                            <strong>Admin:</strong> {{ Str::limit($reply->message, 50) }}
                        </a>
                    </li>
                @empty
                    <li class="dropdown-item text-center text-muted small">No replies yet</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>


<style>
    /* 🔹 Top dark bar styling */
    .container-fluid.bg-dark {
        background-color: #000 !important; /* Pure black */
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    /* 🔹 Navigation links */
    .container-fluid ul li a {
        font-size: 14px;
        letter-spacing: 0.3px;
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .container-fluid ul li a:hover {
        color: #ffcc00 !important;
        transform: translateY(-1px);
    }

    /* 🔹 Space between links */
    .container-fluid ul {
        gap: 1.5rem !important;
    }

    /* 🔹 Chat button design */
    #messagesDropdown {
        background-color: transparent;
        transition: all 0.3s ease;
    }

    #messagesDropdown:hover {
        transform: scale(1.05);
    }

    /* 🔹 Chat icon color and glow on hover */
    #messagesDropdown i {
        transition: all 0.3s ease;
    }
    #messagesDropdown:hover i {
        color: #ffcc00 !important;
        text-shadow: 0 0 5px rgba(255,204,0,0.6);
    }

    /* 🔹 Badge styling */
    #messagesDropdown .badge {
        font-size: 10px;
        padding: 3px 6px;
        box-shadow: 0 0 6px rgba(255,0,0,0.5);
    }

    /* 🔹 Dropdown menu */
    .dropdown-menu {
        background-color: #111;
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
    }

    /* 🔹 Dropdown header */
    .dropdown-header {
        background-color: #000 !important;
        font-size: 14px;
        letter-spacing: 0.5px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    /* 🔹 Dropdown items */
    .dropdown-item {
        color: #ccc !important;
        transition: all 0.2s ease;
        padding: 10px 15px;
        border-radius: 6px;
    }

    .dropdown-item:hover {
        background-color: rgba(255, 204, 0, 0.1);
        color: #ffcc00 !important;
    }

    /* 🔹 Divider subtle effect */
    .dropdown-divider {
        border-color: rgba(255,255,255,0.1);
    }

    /* 🔹 Empty message style */
    .dropdown-item.text-muted {
        opacity: 0.7;
    }

    /* 🔹 Responsive tweaks */
    @media (max-width: 768px) {
        .container-fluid ul {
            gap: 1rem !important;
            flex-wrap: wrap;
            justify-content: center;
        }
    }

    /* 🔸 Make "Message Admin" more prominent */
    .container-fluid ul li a.fw-bold {
        color: #000 !important;
        font-weight: 700 !important;
        background: linear-gradient(90deg, #ffcc00, #ffb700);
        padding: 7px 16px;
        border-radius: 25px;
        text-shadow: 0 0 4px rgba(0,0,0,0.6);
        box-shadow: 0 0 10px rgba(255, 204, 0, 0.4);
        transition: all 0.3s ease;
        border: none;
    }

    .container-fluid ul li a.fw-bold:hover {
        background: linear-gradient(90deg, #ffd84d, #ffcc00);
        color: #000 !important;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 0 15px rgba(255, 204, 0, 0.7);
    }

    /* 💬 Make chat icon truly stand out */
    #messagesDropdown {
        border-radius: 50%;
        background: rgba(255, 204, 0, 0.15);
        padding: 8px 11px;
        box-shadow: 0 0 10px rgba(255, 204, 0, 0.3);
        transition: all 0.3s ease;
    }

    #messagesDropdown i {
        font-size: 1.5rem !important;
        color: #ffcc00 !important;
        transition: all 0.3s ease;
    }

    #messagesDropdown:hover {
        background: rgba(255, 204, 0, 0.3);
        transform: scale(1.1);
        box-shadow: 0 0 20px rgba(255, 204, 0, 0.6);
    }

    #messagesDropdown:hover i {
        color: #fff !important;
        text-shadow: 0 0 8px rgba(255, 204, 0, 1);
    }

    #messagesDropdown .badge {
        background-color: #ff0000 !important;
        box-shadow: 0 0 8px rgba(255,0,0,0.6);
    }
</style>

<!-- Scripts (Bootstrap only once) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
