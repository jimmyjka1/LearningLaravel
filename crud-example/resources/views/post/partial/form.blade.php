<div class="form-group d-flex justify-content-center align-items-center flex-row  my-2">
    <div class="me-1 w-100">
        <input type="text" name="title" id="input_title" class="form-control   @error('title') is-invalid @enderror"
            placeholder="Title" value="{{ old('title', optional($post ?? null)->title) }}">

    </div>
</div>
<div class="text-center">
    @error('title')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group  my-2">
    
    <textarea name="description" placeholder="Description" rows="10" cols="30"
        class="form-control @error('description') is-invalid @enderror">{{ old('description', optional($post ?? null)->description) }}</textarea>
    @error('description')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group my-2">
    <select name="category_id" id="" class="form-select @error('category_id') is-invalid @enderror">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category -> id }}" @selected(old('category_id', optional($post ?? null)->category_id) == $category -> id)>{{ $category -> name }}</option>
        @endforeach

    </select>
    @error('category_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

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
