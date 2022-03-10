<div class="card m-2" style="width: 18rem;">
    <img src="https://media.sproutsocial.com/uploads/2019/09/how-to-write-a-blog-post.svg" class="card-img-top"
        alt="https://media.sproutsocial.com/uploads/2019/09/how-to-write-a-blog-post.svg">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">
            {{ Str::of($post->description)->limit(50) }}
        </p>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('post.show', ['post' => $post->id]) }}" class="btn btn-primary">View</a>
            <div>
                @if (session('user_id'))
                    <spam id='like-count-{{ $post->id }}' class="text-danger">
                        @isset($likes[$post->id])
                            {{ $likes[$post->id]['count'] }}
                        @else
                            0
                        @endisset
                    </spam>

                    @isset($current_user_like[$post->id])
                        <i id="like-button-{{ $post->id }}" onclick="likePost({{ $post->id }})"
                            class="bi bi-heart-fill mt-1 inline-block"></i>
                    @else
                        <i id="like-button-{{ $post->id }}" onclick="likePost({{ $post->id }})"
                            class="bi bi-heart mt-1 inline-block"></i>
                    @endisset
                @endif
            </div>
        </div>
    </div>
</div>
