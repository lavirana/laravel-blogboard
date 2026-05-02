<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class EnsurePostIsPublished

{

    public function handle(Request $request, Closure $next): Response

    {

        $post = $request->route('post');

        if ($post && $post->status !== 'published' && !auth()->user()?->isAdmin()) {

            abort(404, 'Post not found.');

        }

        return $next($request);

    }

}

