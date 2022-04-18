<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\IpAddressLookup;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $location = app()
            ->make(IpAddressLookup::class)
            ->search($request->ip());

        $notifications = auth()->user()
            ->unreadNotifications()
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $posts = Post::orderByDesc('created_at')
            ->limit(10)
            ->get();
        

        return view('home')
            ->with('location', $location)
            ->with('notifications', $notifications)
            ->with('posts', $posts);
    }
}
