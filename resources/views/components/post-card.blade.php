<div>
    <article class="post-card post-card--{{ $size }}">
        @if($post->featured_image)
            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}">
        @endif
        <div class="post-card__body">
            @if($post->category)
                <span class="badge" style="background: {{ $post->category->color }}">
                    {{ $post->category->name }}
                </span>
            @endif
            <h2 class="post-card__title">
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </h2>
            @if($showExcerpt)
                <p class="post-card__excerpt">{{ $post->excerpt }}</p>
            @endif
            <div class="post-card__meta">
                <span>{{ $post->user->name }}</span>
                <span>{{ $post->published_at?->diffForHumans() }}</span>
                <span>{{ number_format($post->views) }} views</span>
            </div>
        </div>
    </article>
</div>