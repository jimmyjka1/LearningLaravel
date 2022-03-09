@extends('layout.master')

@section('title', 'Create User')


@section('content')
<div class="d-flex flex-column justify-content-center align-items-center">
    <form action="{{ route('user.store') }}" method="post" class="w-50 shadow-sm px-5 pb-5" id="create-user-form">
            <h2 class="text-center">Create New User</h2>
            @csrf
            @include('user.partial.form')
            <button type="submit" class="btn btn-primary w-100 my-2">Submit</button>
            
        </form>
    </div>

    {!! JsValidator::formRequest('App\Http\Requests\UserFormRequest', '#create-user-form'); !!}

@endsection