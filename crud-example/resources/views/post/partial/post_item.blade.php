<div class="card m-2 row m-0" style="width: 60rem; height: 20rem">
    <div class="card-body row">
        <img src="https://media.sproutsocial.com/uploads/2019/09/how-to-write-a-blog-post.svg" class="col-6"
            alt="https://media.sproutsocial.com/uploads/2019/09/how-to-write-a-blog-post.svg">
        <div class="detailContainer col-6 py-3">
            <a class="blog-title" href="{{ route('post.show', ['post' => $post -> id]) }}">
                <h5 class="card-title m-0">{{ $post->title }}</h5>
            </a>
            <small class="text-secondary">
                by {{ $post_auther[$post->id]->first_name }} {{ $post_auther[$post->id]->last_name }} |

                @if ($post->updated_at->diffInSeconds($current_time) < 30)
                    <span class="d-inline-block mt-1 bg-danger p-1 text-white">New</span>
                @else
                    {{ $post->updated_at->diffForHumans() }}
                @endif
            </small>
            <p class="mt-3 card-text">
                {{ Str::of($post->description)->limit(30) }}
            </p>

            <div class="d-flex justify-content-between align-items-center like-btn-container">
                <div>
                    <span>
                        @isset($comments[$post->id])
                            {{ $comments[$post->id]['count'] }}
                        @else
                            0
                        @endisset
                    </span>
                    <i class="bi bi-chat me-4"></i>
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
</div>
