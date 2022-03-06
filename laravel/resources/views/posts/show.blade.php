@extends('layouts.app')

@section('title', $post['title'])


@section('content')
    {{-- @if ($post['is_new'])
        <div>A new Blog post! Using if</div>
    @else
        <div>This Blog post is old! using else</div>
    @endif --}}


    {{-- @unless ($post['is_new'])
        <div>This is old blog post.. using unless</div>
    @endunless --}}
    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>

    {{-- @isset($post['has_comments'])
        <div>There are some comments, using isset</div>
    @endisset --}}


    <div class="m-1">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
        <a href="{{ route('posts.index') }}">Show All Post</a>
    </div>

@endsection