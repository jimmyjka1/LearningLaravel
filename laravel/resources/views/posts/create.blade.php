@extends('layouts.app')


@section('title', 'Create the post')



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
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="title" id="input_title" placeholder="Enter Title Of the post"
                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <textarea name="content" id="input_content" cols="30" rows="10"
                    class="form-control @error('content') is-invalid @enderror"
                    placeholder="Enter Content of the post">{{ old('content') }}</textarea>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('posts.index') }}">Show All Posts</a>
            </div>
        </form>
    </div>

@endsection
