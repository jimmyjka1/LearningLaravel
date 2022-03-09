@extends('layout.master')

@section('title', 'Create Post')


@section('content')
<div class="d-flex flex-column justify-content-center align-items-center">
    <form action="{{ route('post.store') }}" method="post" class="w-50 shadow-sm px-5 pb-5" id="create-user-form">
            <h2 class="text-center">Create New Post</h2>
            @csrf
            @include('post.partial.form')
            <button type="submit" class="btn btn-primary w-100 my-2">Submit</button>
            
        </form>
    </div>

    {!! JsValidator::formRequest('App\Http\Requests\UserFormRequest', '#create-user-form'); !!}

@endsection