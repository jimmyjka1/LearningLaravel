@extends('layout.master')



@section('title', 'New User')
@section('sidebar_title', 'Form Validation')



@section('content')

    <link rel="stylesheet" href="{{ asset('css/createUserStyle.css') }}">
    <form class="newUserForm p-5 mt-2" enctype="multipart/form-data" method="POST" action="{{ route('user.create') }}"
        id="user-form">
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
                    id="validatedInputGroupCustomFile" name="image_file" onchange="readURL(this)" value="{{ old('image_file') }}">
                <label class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
                @error('image_file')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-center align-items-center m-2">
                    <img src="{{ old('image_file') }}"
                        alt="Uploaded Image" id="uploadedImage">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>

    </form>

    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script> --}}
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\UserFormRequest', '#user-form') !!}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#uploadedImage').attr('src', e.target.result).width(150).height(200);
                    $('#validatedInputGroupCustomFile').attr('value', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
