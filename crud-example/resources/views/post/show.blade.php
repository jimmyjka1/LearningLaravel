@extends('layout.master')

@section('title', 'All Users')


@section('content')
    <div class=" d-flex justify-content-center align-items-center flex-column">
        <div class="shadow-sm w-50">
            <h2 class="text-center">{{ $user -> first_name }} {{ $user -> last_name }}</h2>
            <div class="userContainerList p-3">
                <table width='300px' class="table table-striped">
                    <tr>
                        <th>First name: </th>
                        <td>{{ $user -> first_name }}</td>
                    </tr>
                    <tr>
                        <th>Last Name: </th>
                        <td>{{ $user -> last_name }}</td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td>{{ $user -> email }}</td>
                    </tr>
                    <tr>
                        <th>Role ID: </th>
                        <td>{{ $user -> role_id }}</td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td>{{ $user -> status }}</td>
                    </tr>
                    <tr>
                        <th>Created At: </th>
                        <td>{{ $user -> created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At: </th>
                        <td>{{ $user -> updated_at }}</td>
                    </tr>
                    
                </table>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <a href="{{ route('user.edit', ['user' => $user -> id]) }}" class="btn btn-warning m-2">Edit</a>
                <a href="{{ route('user.index') }}" class="btn btn-primary m-2">Show All Users</a>
            </div>
        </div>

    </div>
@endsection