@extends('layouts.app')



@section('title', 'Create User')
@section('page-heading', 'Create New User')


@section('content')

    <form method="POST" action="{{ route('users.update', ['user' => $user -> id]) }}" id="create-form">
        @csrf
        @method('PUT')
        @include('users.partial.form')

        <input type="hidden" name="user_id" value="{{ $user -> id }}">
        <div class="button-container">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\UpdateUserRequest', '#create-form'); !!}
@endsection
