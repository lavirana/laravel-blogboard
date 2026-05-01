<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags'])
            ->published()
            ->paginate(15);
        return PostResource::collection($posts);
    
    }
    
    public function show(Post $post)
    {
        $post->load(['user', 'category', 'tags', 'comments']);
        return new PostResource($post);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
