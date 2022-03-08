<div class="form-group">
    <input type="text" name="title" id="input_title" placeholder="Enter Title Of the post"
        class="form-control @error('title') is-invalid @enderror" value="{{ old('title', optional($post ?? null) -> title) }}">
    @error('title')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <textarea name="content" id="input_content" cols="30" rows="10"
        class="form-control @error('content') is-invalid @enderror"
        placeholder="Enter Content of the post">{{ old('content', optional($post ?? null) -> content) }}</textarea>
    @error('content')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<style>
    .error-help-block {
        color: red;
    }
</style>