@extends('layout.master')

@section('title', 'All Users')


@section('content')
    <div class=" d-flex justify-content-center align-items-center flex-column">
        <div class="shadow-sm w-50">
            <h2 class="text-center">All Users</h2>
            <div class="userContainerList p-3">
                <table width="300px" class="table table-striped p-3">
                    <tr>
                        <th class="p-2">User ID</th>
                        <th class="p-2">Full Name</th>
                        <th class="p-2">Email</th>
                        <th class="p-2">Action</th>
                    </tr>
                    @foreach ($users as $user)
                        @include('user.partial.user_item')
                    @endforeach
                </table>

                <a href="{{ route('user.create') }}" class="btn btn-success">Create New User</a>
            </div>
        </div>

    </div>
@endsection