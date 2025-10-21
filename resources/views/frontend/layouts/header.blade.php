<div class="container">
    <div class="header_section_top">
        <div class="row">
            <div class="col-sm-12">
                <div class="custom_menu">
                    <ul>
                        <li><a href="#">Best Sellers</a></li>
                        <li><a href="#">Gift Ideas</a></li>
                        <li><a href="#">New Releases</a></li>
                        <li><a href="#">Today's Deals</a></li>
                        <li><a href="{{ route('contact.admin') }}"> <strong>Message Admin</strong> </a></li>

                        <li class="nav-item">
                            <a href="{{ route('user.messages') }}" class="nav-link">
                                <i class="fas fa-envelope"></i>
                                <span class="badge bg-danger">
            {{ \App\Models\Message::where('user_id', auth()->id())->whereHas('replies', function($q){ $q->where('is_read', 0); })->count() }}
        </span>
                                My Messages
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
