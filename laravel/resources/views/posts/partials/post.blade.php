{{-- @php 
    dd($post);
@endphp --}}
<div class="m-1">
    <span>{{ $key + 1 }}. {{ $post['title'] }}</span>
    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="m-1 btn btn-success">View</a>
</div>
