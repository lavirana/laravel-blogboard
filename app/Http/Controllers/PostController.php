<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;


class PostController extends Controller
{
    public function index(){
        $posts = Post::with(['user', 'category', 'tags'])
        ->published()
        ->latest('published_at')
        ->paginate(12);
    }

      // GET /posts/create — show create form
      public function create()
      {
          $categories = Category::all();
          return view('posts.create', compact('categories'));
      }
        // POST /posts — store new post

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
            'slug'    => str($request->title)->slug() . '-' . rand(1000, 9999),
        ]);
        return redirect()->route('posts.show', $post)
            ->with('success', 'Post created successfully!');
    }

    // GET /posts/{post} — show a single post
    public function show(Post $post)
    {
        $post->increment('views');
        $post->load(['user', 'category', 'tags', 'comments' => fn($q) => $q->where('approved', true)]);
        return view('posts.show', compact('post'));
    }

     // GET /posts/{post}/edit

     public function edit(Post $post)
     {
         $categories = Category::all();
         return view('posts.edit', compact('post', 'categories'));
     }
        // PUT /posts/{post}

        public function update(UpdatePostRequest $request, Post $post)
        {
            $post->update($request->validated());
            return redirect()->route('posts.show', $post)->with('success', 'Post updated!');
        }

        // DELETE /posts/{post}
        public function destroy(Post $post)
        {
            $post->delete(); // soft delete
            return redirect()->route('posts.index')->with('success', 'Post deleted.');
        }




  
}
