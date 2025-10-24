<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Message;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();

        // ✅ Admin header messages
        View::composer('admin.layouts.header', function ($view) {
            $messages = Message::with('user')
                ->latest()
                ->take(5)
                ->get();

            $view->with(compact('messages'));
        });

        // ✅ Frontend header (for user replies)
        View::composer('frontend.layouts.header', function ($view) {
            if (auth()->check()) {
                $userId = auth()->id();

                $userUnreadRepliesCount = Message::where('is_read', 0)
                    ->where('user_id', $userId)
                    ->whereNotNull('parent_id')
                    ->count();

                $userRecentReplies = Message::where('user_id', $userId)
                    ->whereNotNull('parent_id')
                    ->latest()
                    ->take(5)
                    ->get();

                $view->with(compact('userUnreadRepliesCount', 'userRecentReplies'));
            } else {
                $view->with(['userUnreadRepliesCount' => 0, 'userRecentReplies' => collect()]);
            }
        });
    }
}
