@extends('layouts.app')
@section('content')
<div class="container">
    <article class="post-single">
        {{-- Hero Header --}}
        <header class="post-header">
            @if($post->category)
                <span class="badge" style="background: {{ $post->category->color }}">
                    {{ $post->category->name }}
                </span>
            @endif

            <!-- Only show edit button if user can edit this post -->

                @can('update', $post)

                <a href="{{ route('posts.edit', $post) }}">Edit</a>

                @endcan

                @can('delete', $post)

                <form method="POST" action="{{ route('posts.destroy', $post) }}">

                    @method('DELETE') @csrf

                    <button type="submit">Delete</button>

                </form>

            @endcan


            
            <h1 class="post-title">{{ $post->title }}</h1>
            
            <div class="post-meta">
                <strong>By {{ $post->user->name }}</strong>
                <span>• {{ $post->published_at?->format('M d, Y') }}</span>
                <span>• {{ number_format($post->views) }} views</span>
            </div>
        </header>

        {{-- Featured Image --}}
        @if($post->featured_image)
            <div class="post-image">
                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="img-fluid">
            </div>
        @endif

        {{-- Main Content --}}
        <div class="post-content">
            {!! nl2br(e($post->body)) !!}
        </div>

        {{-- Tags Section --}}
        @if($post->tags->count() > 0)
            <div class="post-tags">
                @foreach($post->tags as $tag)
                    <span class="tag-item">#{{ $tag->name }}</span>
                @endforeach
            </div>
        @endif

        <hr>

        {{-- Comments Section --}}
        <section class="post-comments">
            <h3>Comments ({{ $post->comments->count() }})</h3>
            
            @forelse($post->comments as $comment)
                <div class="comment">
                    <strong>{{ $comment->user?->name ?? $comment->author_name }}</strong>
                    <p>{{ $comment->body }}</p>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p>No comments yet. Be the first to share your thoughts!</p>
            @endforelse
        </section>
    </article>
</div>
@endsection