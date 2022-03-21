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
    <p>
        {{ $post['content'] }}
        <br>
        <small class="text-grey">Laste change {{ $post -> updated_at -> diffForHumans() }}</small>
    </p>


    @if (now() -> diffInMinutes($post -> created_at) < 5)
        <div class="alert alert-info">New!</div>
    @endif

    <div class="m-1">
        <a href="{{ route('posts.edit', ['post' => $post -> id ]) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('posts.index') }}">Show All Post</a>
    </div>

    <h4 class="mt-5">Comments</h4>
    @forelse ($post -> comments as $comment)
        <p class="card m-1 p-3 w-50">
            {{ $comment -> content }} <small class="text-muted"><i>{{ $comment -> created_at -> diffForHumans() }}</i></small>
        </p>
    @empty
        <p>No Comments found</p>
    @endforelse

@endsection


