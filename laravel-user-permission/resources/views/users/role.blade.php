@extends('layouts.app')



@section('title', 'User Role')
@section('page-heading', $user -> name)


@section('content')
    <div class="d-flex justify-content-center align-items-center w-100">
        <form class="w-100 d-flex justify-content-center flex-column" action="">
            <table class=" table w-75">
                @foreach ($roles  as $role)
                    <tr>
                        <td><label for="input_role_{{ $role -> id }}">{{ $role -> name }}</label></td>
                        <td><input type="checkbox" name="role_{{ $role -> id }}" value="{{ $role -> id }}" class="form-checkbox" id="input_role_{{ $role -> id }}" @checked($user -> roles -> contains($role -> id))></td>
                    </tr>
                @endforeach
            </table>
            <div class="button-container d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <style>
        td {
            padding-left: 1em;
            padding-right: 1em;
        }

        table{
            width: 500px
        }
    </style>
@endsection