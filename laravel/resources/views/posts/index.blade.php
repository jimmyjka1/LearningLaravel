@extends('layouts.app')

@section('title', 'Posts')


@section('content')
    @forelse ($posts as $key => $post)
        @include('posts.partials.post')
    @empty
        No post found
    @endforelse



@endsection