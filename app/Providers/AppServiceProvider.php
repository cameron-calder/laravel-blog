<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use App\Observers\CommentObserver;
use App\Observers\FeedbackObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        User::observe(UserObserver::class);
        Comment::observe(CommentObserver::class);
        Feedback::observe(FeedbackObserver::class);
    }
}
