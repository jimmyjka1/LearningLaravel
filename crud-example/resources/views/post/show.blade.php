@extends('layout.master')

@section('title', 'Post')


@section('content')
    <div class="d-flex justify-content-center align-items-center flex-column">
        <div class="py-5 px-2 post-container w-50 d-flex justify-content-center align-items-center flex-column">
            <h2 class="text-center">{{ $post->title }}</h2>
            <div class="post-description w-75">

                <img src="https://media.sproutsocial.com/uploads/2019/09/how-to-write-a-blog-post.svg"
                    alt="https://media.sproutsocial.com/uploads/2019/09/how-to-write-a-blog-post.svg" id="blog-image">
                {{ $post->description }}

            </div>
            <div class="button-container d-flex justify-content-center align-items-center m-5">



                @if (session('user_id'))
                    @if ($current_user <= 0)
                        <button id='like-button' onclick="likePost({{ $post->id }})"
                            class="btn btn-outline-success m-2"><i class="bi bi-heart mt-1 inline-block"
                                id="heart-icon"></i>&nbsp;<span id="like-count">{{ $like_count }}</span></button>
                    @else
                        <button id='like-button' onclick="likePost({{ $post->id }})" class="btn btn-success m-2"><i
                                class="bi bi-heart-fill mt-1 inline-block"></i>&nbsp;<span
                                id="like-count">{{ $like_count }}</span></button>
                    @endif
                @endif

                @if (session('user_id') == $post->user_id)
                    <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="btn btn-outline-warning m-2"><i
                            class="bi bi-pencil"></i></a>
                    <form action="{{ route('post.destroy', ['post' => $post->id]) }}"
                        onsubmit="return confirm('Do you really want to delete this post ?')" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger m-2"><i class="bi bi-trash-fill"></i></button>
                    </form>
                @endif
            </div>

            @if (session('user_id'))
                <div class="commentContainer p-3 w-100">
                    <div class="commentFormContainer row">
                        <spam class="col-2 d-flex justify-content-center align-items-center">User Name</spam>
                        <input type="text" name="comment" id="input_comment" class="col-7">
                        <button class="d-inline-block btn btn-secondary col-2 m-1">Comment</button>
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-center align-items-center">
                    <a href="{{ route('user.login_page') }}" class="btn btn-primary">Login to Comment</a>
                </div>
            @endif
        </div>

    </div>
    <style>
        .post-container {
            border: 1px solid rgba(0, 0, 0, 0.151);
            border-radius: 5px;
            padding-bottom: 0.5rem !important;
        }

        #blog-image {
            margin-left: -6.4rem;
            height: 500px;
            /* border: 1px solid black; */
            width: 136%;
        }

        .commentContainer {
            border: 1px solid rgba(0, 0, 0, 0.151);
            border-radius: 5px;
            background-color: white
        }

    </style>
    <script>
        function likePost(id) {
            console.log("GOING HERE");
            $button = $('#like-button');
            $heart_button = $('#heart-icon');
            if ($button.hasClass('btn-outline-success')) {
                $.post({
                    url: "{{ route('like_post.like') }}",
                    data: {
                        post_id: id
                    },
                    success: function($response) {
                        $('#like-count').text($response);
                        $button.removeClass('btn-outline-success');
                        $button.addClass('btn-success');
                        $heart_button.removeClass('bi-heart');
                        $heart_button.addClass('bi-heart-fill');
                    }
                });
            } else {
                $.post({
                    url: "{{ route('like_post.dislike') }}",
                    data: {
                        post_id: id
                    },
                    success: function($response) {
                        $('#like-count').text($response);
                        $button.removeClass('btn-success');
                        $button.addClass('btn-outline-success');
                        $heart_button.removeClass('bi-heart-fill');
                        $heart_button.addClass('bi-heart');
                    }
                })
            }
        }
    </script>
@endsection
