<div>
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="nav-logo">
                Blog<span>Board</span>
            </a>
            
            <ul class="nav-links">
                <li><a href="{{ route('posts.index') }}" class="active">Articles</a></li>
                <li><a href="{{ route('jobs.index') }}" class="active">Jobs</a></li>
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#" class="nav-btn">Write a Post</a></li>
            </ul>
        </div>
    </nav>
</div>