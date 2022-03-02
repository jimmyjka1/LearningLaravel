@extends('layouts.app')

@section('title', 'Posts')


@section('content')
    @foreach ($posts as $key => $post)
        <h1>{{ $key }}.{{ $post['title'] }}</h1>
        <p>{{ $post['content'] }}</p>
    @endforeach



@endsection