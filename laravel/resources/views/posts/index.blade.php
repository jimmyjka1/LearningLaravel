@extends('layouts.app')

@section('title', 'Posts')


@section('content')
    @forelse ($posts as $key => $post)
        @include('posts.partials.post')
    @empty
        No post found
    @endforelse


    <div class="m-2">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
    </div>

    <style>
        a.post-link {
            text-decoration: none;
            color: black;
        }
        a.post-link:hover {
            text-decoration: underline;
            
        }

        .card {
            transition: all 0.3s;
        }

        .card:hover {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.159);
        }
    </style>

@endsection