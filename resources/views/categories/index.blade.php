@extends('layouts.app')
@section('content')
<div class="container">
        @foreach ($categories as $cat)
        <article class="post-card" style="margin-bottom: 4%;">
            {{-- Job Type Badge --}}
            <div class="post-card__body">
                {{-- Job Title --}}
                <h2 class="post-card__title">
                    <a href="{{ route('jobs.show', $cat) }}">{{ $cat->name }}</a>
                </h2>
    
                {{-- Company & Location --}}
                <p class="post-card__excerpt">
                    <strong>{{ $cat->description }}</strong> <br>
                     {{ $cat->color }}
                </p>
    
                {{-- Salary & Expiry Meta --}}
                <div class="post-card__meta">
                    <span>Created At: {{ \Carbon\Carbon::parse($cat->created_at)->format('M d') }}</span>
                </div>
            </div>
        </article>
        @endforeach
</div>
@endsection