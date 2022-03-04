@extends('layout.master')



@section('title', 'New User')
@section('sidebar_title', 'Form Validation')



@section('content')

    <link rel="stylesheet" href="{{ asset('css/createUserStyle.css') }}">
    <form class="newUserForm p-5 mt-2" enctype="multipart/form-data" method="POST" action="{{ route('user.create') }}">
        @csrf
        <h1>Create New User</h1>
        <div class="form-group">
            <label for="input_first_name">
                First Name
            </label>
            <input type="text" name="first_name" id="input_first_name"
                class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group">
            <label for="input_last_name">
                Last Name
            </label>
            <input type="text" name="last_name" id="input_last_name"
                class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="input_email">
                Email
            </label>
            <input type="text" name="email" id="input_email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="input_phone">
                Phone
            </label>
            <input type="text" name="phone" id="input_phone" class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone') }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="input_password">
                Password
            </label>
            <input type="text" name="password" id="input_password"
                class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="input_address">
                Address
            </label>
            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="input_address"
                cols="30" rows="10">{{ old('address') }}</textarea>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-check d-flex justify-content-cetner align-items-center">
                <input type="radio" name="gender" id="input_female" value="1"
                    class="form-check-input @error('gender') is-invalid @enderror" @checked(old('gender')=='1' )>
                <label for="input_female" class="form-check-label">Female</label>
            </div>
            <div class="form-check d-flex justify-content-cetner align-items-center">
                <input type="radio" name="gender" id="input_male" value="2"
                    class="form-check-input @error('gender') is-invalid @enderror" @checked(old('gender')=='2' )>
                <label for="input_male" class="form-check-label">Male</label>
            </div>
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-5">
            {{-- <label for="input_cast">Cast</label> --}}
            <select name="cast" id="input_cast" class="custom-select @error('cast') is-invalid @enderror">
                <option value="">Select Cast</option>
                <option value="ABC" @selected(old('cast')=='ABC' )>ABC</option>
                <option value="DEF" @selected(old('cast')=='DEF' )>DEF</option>
                <option value="GHI" @selected(old('cast')=='GHI' )>GHI</option>
            </select>
            @error('cast')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('image_file') is-invalid @enderror"
                    id="validatedInputGroupCustomFile" name="image_file" onchange="readURL(this)">
                <label class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
                @error('image_file')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-center align-items-center m-2">
                    <img src="data:image/png;base64,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" alt="Uploaded Image" id="uploadedImage">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>

    </form>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#uploadedImage').attr('src', e.target.result).width(150).height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
