@extends('layout.master')



@section('title', 'New User')
@section('sidebar_title', 'Form Validation')



@section('content')
    <link rel="stylesheet" href="{{ asset('css/createUserStyle.css') }}">
    <h1>Create New User</h1>
    <div class="newUserForm p-5">
        <div class="form-group">
            <label for="input_first_name">
                Email: 
            </label>
            <input type="text" name="first_name" id="input_first_name" class="form-control">
        </div>
    </div>
@endsection