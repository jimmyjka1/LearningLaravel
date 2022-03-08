{{-- @php 
    dd($post);
@endphp --}}
<div class="m-1">
    <span>{{ $key + 1 }}. {{ $post['title'] }}</span>
    <a href="{{ route('posts.show', ['post' => $post -> id]) }}" class="m-1 btn btn-success">View</a>
    <a href="{{ route('posts.edit', ['post' => $post -> id ]) }}" class="m-1 btn btn-warning">Edit</a>
    <form class="d-inline-block" action="{{ route("posts.destroy", ['post' => $post -> id]) }}" method="POST" onsubmit="return confirm('Do you reslly want to delete this post ?')">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
