<?php

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
    return view('welcome');
});

Route::middleware(['auth'])
    ->group(function () {
        Route::get('/posts', [PostController::class, 'index'])
            ->name('posts');
        Route::get('/post/view/{post}', [PostController::class, 'show'])
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
    });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
