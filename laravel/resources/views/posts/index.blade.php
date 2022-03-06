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



@endsection