@extends('layout.master')
@section('title', 'Home')


@section('content')
    <h1>Home</h1>
    <p>Logged In User id : 
        @if (session('user_id'))
            {{ session('user_id') }}
        @endif
    </p>
@endsection