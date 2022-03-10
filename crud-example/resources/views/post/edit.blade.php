@extends('layout.master')

@section('title', 'Edit')


@section('content')
<div class="d-flex flex-column justify-content-center align-items-center">
    <form action="{{ route('post.update', ['post' => $post -> id ]) }}" method="post" class="w-50 shadow-sm px-5 pb-5" id="create-user-form">
            <h2 class="text-center">Update Post</h2>
            @csrf
            @method('PUT')
            @include('post.partial.form')
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary m-2">Save</button>
                <a href="{{ route('post.show', ['post' => $post -> id]) }}">Cancel</a>
            </div>
        </form>
    </div>

    {!! JsValidator::formRequest('App\Http\Requests\UserFormRequest', '#create-user-form'); !!}

@endsection