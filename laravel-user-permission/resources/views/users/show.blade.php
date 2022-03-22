@extends('layouts.app')


@section('title', $user -> name)

@section('page-heading', $user -> name);


@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h2 class="m-5">User Details</h2>

        <table class="table table-stripted">
            <tr>
                <th>Name: </th>
                <td>{{ $user -> name }}</td>
            </tr>
            <tr>
                <th>Email: </th>
                <td>{{ $user -> email }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $user -> created_at }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $user -> updated_at }}</td>
            </tr>
            <tr>
                <th>Verified at</th>
                <td>{{ $user -> verified_at }}</td>
            </tr>
            <tr>
                <th>Remember Token</th>
                <td>{{ $user -> remember_token }}</td>
            </tr>
            <tr>

            </tr>
        </table>
        <div class="button-contain">
            <a href="{{ route('users.edit', ['user' => $user -> id]) }}" class="btn btn-warning">Edit</a>
            <form class="d-inline" action="{{ route('users.destroy', ['user' => $user -> id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('users.index') }}" class="m-2">Go Back</a>
        </div>
    </div>

@endsection