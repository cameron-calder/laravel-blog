<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostFeedbackController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->guest()) {
        return redirect()->route('login');
    }
    return redirect()->route('home');
});

Route::middleware(['auth'])
    ->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/posts', [PostController::class, 'index'])
            ->name('posts');
        Route::get('/posts/user', [PostController::class, 'userPosts'])
            ->name('posts.user');
        Route::get('/post/view/{post_id}', [PostController::class, 'show'])
            ->name('post.view');
        Route::get('/post/create', [PostController::class, 'create'])
            ->name('post.create');
        Route::post('/post/create/submit', [PostController::class, 'store'])
            ->name('post.create.submit');
        Route::get('/post/edit/{post}', [PostController::class, 'edit'])
            ->name('post.edit');
        Route::post('/post/{post}/edit/submit', [PostController::class, 'update'])
            ->name('post.edit.submit');
        Route::post('/post/delete/{post}', [PostController::class, 'destroy'])
            ->name('post.delete');

            
        Route::post('/post/feedback/update', [PostFeedbackController::class, 'store'])
            ->name('post.feedback.update');
            
        Route::post('/post/comment/create/{post}', [CommentController::class, 'store'])
            ->name('post.comment.submit');
        Route::post('/post/comment/delete/{comment}', [CommentController::class, 'destroy'])
            ->name('comment.delete');
        Route::post('/post/comment/update/{comment}', [CommentController::class, 'update'])
            ->name('comment.update');

        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications');
    });


Auth::routes();
