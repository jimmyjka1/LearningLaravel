<div class="form-group d-flex justify-content-center align-items-center flex-row  my-2">
    <div class="me-1 w-100">
        <input type="text" name="first_name" id="input_first_name"
            class="form-control   @error('first_name') is-invalid @enderror" placeholder="First Name"
            value="{{ old('first_name', optional($user ?? null)->first_name) }}">

    </div>
    <div class="ms-1 w-100">
        <input type="text" name="last_name" id="input_last_name"
            class="form-control  @error('last_name') is-invalid @enderror" placeholder="Last Name"
            value="{{ old('last_name', optional($user ?? null)->last_name) }}">

    </div>
</div>
<div class="text-center">
    @error('last_name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    @error('first_name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group  my-2">
    <input type="email" name="email" id="input_email" placeholder="Email Id"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', optional($user ?? null)->email) }}">
    @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group my-2">
    <select name="role_id" id="input_role_id" class="form-select @error('role_id') is-invalid @enderror">
        <option value="">Select Role ID</option>
        <option value="1" @selected(old('role_id', optional($user ?? null)->role_id) == 1)>1</option>
        <option value="2" @selected(old('role_id', optional($user ?? null)->role_id) == 2)>2</option>
        <option value="3" @selected(old('role_id', optional($user ?? null)->role_id) == 3)>3</option>
    </select>
    @error('role_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

@unless(isset($user))
    <div class="form-group my-2">
        <input type="text" name="password" id="input_password" class="form-control @error('password') is-invalid @enderror"
            placeholder="Enter Password" value="{{ old('password') }}">
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group my-2">
        <input type="text" name="password_confirmation" id="input_password"
            class="form-control @error('password') is-invalid @enderror" placeholder="Re-Enter Password"
            value="{{ old('password_confirmation') }}">
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
@endunless

<div class="form-group">
    <input type="file" name="image" id="input_image" class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<style>
    .error-help-block {
        color: red;
    }

</style>
