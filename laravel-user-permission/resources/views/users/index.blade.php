@extends('layouts.app')



@section('title', 'Users')
@section('page-heading', 'All Users')


@section('content')
    {{-- @sortablelink('name') --}}
    <div class="num-selector d-flex align-items-center">
        Num Rows:
        <select class="form-control w-25 m-1" name="num_rows" id="input_num_rows">
            <option value="5" @selected($num_rows == 5)>5</option>
            <option value="10" @selected($num_rows == 10)>10</option>
            <option value="20" @selected($num_rows == 20)>20</option>
            <option value="50" @selected($num_rows == 50)>50</option>
            <option value="100" @selected($num_rows == 100)>100</option>
        </select>
    </div>
    <table class="w-100 table table-striped-primary">
        <tr>
            <th>@sortablelink('id', 'ID')</th>
            <th>@sortablelink('name')</th>
            <th>@sortablelink('email')</th>
            <th>Role</th>
            <th>@sortablelink('created_at', 'Created At')</th>
            <th>@sortablelink('updated_at', 'Updated At')</th>
            <th>@sortablelink('verified_at', 'Verified At')</th>
            <th>Remember Token</th>
            <th> </th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user -> roles as $role)
                        <span class="badge badge-success">{{ $role -> name }}</span>
                    @endforeach
                </td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>{{ $user->verified_at }}</td>
                <td>{{ Str::of($user->remember_token)->limit(10) }}</td>
                <td>
                    <div class="dropdown show">
                        <div class="btn-group dropleft">
                            <i class="d-inline-block fas fa-ellipsis-v px-2" data-toggle="dropdown"
                                aria-expanded="false"></i>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('users.edit', ['user' => $user->id]) }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('users.role', ['user' => $user -> id]) }}">Role</a>
                                <a class="dropdown-item" href="#">Permissions</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); if (confirm('Do you really want to delte {{ $user -> name }} ?')){ document.getElementById('logout-form-{{ $user ->id }}').submit()};">
                                    {{ __('Delete') }}
                                </a>

                                <form  id="logout-form-{{ $user -> id }}" action="{{ route('users.destroy', ['user' => $user -> id]) }}" method="POST"
                                    class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="page-links-container p-2 m-2">
        {{ $users->links() }}
    </div>
    <style>
        td,
        th {
            padding: 1em;
        }

        tr:hover {
            background-color: rgba(0, 0, 0, 0.103);
        }

        i.fas.fa-ellipsis {
            cursor: pointer
        }

    </style>

    <script>
        $('#input_num_rows').on('change', function(e) {
            value = this.value;
            console.log(value);

            var url = new URL(window.location.href);
            url.searchParams.set('num_rows', value);
            url.searchParams.set('page', 1);
            document.location = url.href;
        });
    </script>
@endsection
