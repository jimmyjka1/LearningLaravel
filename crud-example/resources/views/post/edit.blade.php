@extends('layout.master')

@section('title', 'Create User')


@section('content')
<div class="d-flex flex-column justify-content-center align-items-center">
    <form action="{{ route('user.update', ['user' => $user -> id ]) }}" method="post" class="w-50 shadow-sm px-5 pb-5" id="create-user-form">
            <h2 class="text-center">Update User</h2>
            @csrf
            @method('PUT')
            @include('user.partial.form')
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary m-2">Save</button>
                <a href="{{ route('user.show', ['user' => $user -> id]) }}">Cancel</a>
            </div>
        </form>
    </div>

    {!! JsValidator::formRequest('App\Http\Requests\UserFormRequest', '#create-user-form'); !!}

@endsection