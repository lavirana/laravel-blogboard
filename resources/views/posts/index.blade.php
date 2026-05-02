@extends('layouts.app')
@section('content')
@foreach($posts as $post)
    <x-post-card :post="$post" size="lg" />
@endforeach
@endsection