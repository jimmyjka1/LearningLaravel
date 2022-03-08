@extends('layouts.app')


@section('title', 'Update the post')



@section('content')
    <div class="m-2">
        @if ($errors->any())
            <div>
                <ul class="text-danger">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('posts.update', ['post' => $post -> id]) }}" method="post" id="update-form">
            @csrf
            @method('PUT')
            @include('posts.partials.form')
            <div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('posts.index') }}">Cancel</a>
            </div>
        </form>
    </div>
    {!! JsValidator::formRequest('App\Http\Requests\StorePost', "#update-form") !!}
@endsection
