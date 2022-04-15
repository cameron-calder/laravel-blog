<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        
        return view('post.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')
            ->with('post', new Post());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = auth()->user()
            ->posts()
            ->create($request->validated() + [
                'thumbnail_path' => $request->saveImage(),
            ]);
            
        return redirect()
        ->route('post.view', $post->id)
        ->with('success', 'Successfully created post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $post_id)
    {
        $post = Post::with([
                'comments' => function ($query) {
                    $query->orderByDesc('created_at');
                },
            ])
            ->where('id', $post_id)
            ->firstOrFail();

        return view('post.show')
            ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.create')
            ->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, Post $post)
    {
        if (!$post->isOwner()) {
            abort(403, 'You do not have permission to update this post');
        }

        $post->update($request->validated() + [
            'thumbnail_path' => $request->saveImage(),
        ]);
        
        return redirect()
            ->route('post.view', $post->id)
            ->with('success', 'Successfully updated post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!$post->isOwner()) {
            abort(403, 'You do not have permission to delete this post');
        }

        $post->delete();

        return redirect()
            ->route('posts');
    }
}
