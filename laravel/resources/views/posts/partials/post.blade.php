{{-- @php 
    dd($post);
@endphp --}}


<div class="card w-50 p-2 m-2">
    <h3>{{ $key + 1 }}. <a class="post-link"
            href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post['title'] }}</a></h3>
    @if ($post->comments_count)
        {{-- <div><i class="bi bi-chat-dots"></i> {{ $post->comments_count }}</div> --}}
        <div>{{ $post->comments_count }} comments</div>
    @else
        <div>No Commetns yet!</div>
    @endif

    <div>
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="m-1 btn btn-warning">Edit</a>
        <form class="d-inline-block" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST"
            onsubmit="return confirm('Do you reslly want to delete this post ?')">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
