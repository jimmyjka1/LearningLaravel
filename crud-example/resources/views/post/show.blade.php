@extends('layout.master')

@section('title', 'Post')


@section('content')
    <div class="d-flex justify-content-center align-items-center flex-column">
        <div class="py-5 px-2 post-container w-50 d-flex justify-content-center align-items-center flex-column">
            <div class="w-100">
                <i class="bi bi-arrow-left-short ms-4 back-arrow" onclick="window.location='{{ route('post.index') }}'"></i>
            </div>
            <h2 class="text-center">{{ $post->title }}</h2>
            <span class="text-secondary">{{ $auther->first_name }} {{ $auther->last_name }} | changed
                {{ $post->updated_at->diffForHumans() }}</span>
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

            <h4>Comments</h4>
            <div class="commentContainer p-3 w-100">
                <div class="commentFormContainer row">
                @if (session('user_id'))
                        <b class="col-2 d-flex justify-content-center align-items-center">{{ $user->first_name }}
                            {{ $user->last_name }}</b>
                        <input type="text" name="comment" id="input_comment" class="col-7">
                        <button class="d-inline-block btn btn-secondary col-2 m-1" onclick="comment()">Comment</button>
                @else
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('user.login_page') }}" class="btn btn-primary">Login to Comment</a>
                        </div>
                @endif

                        <div id="commentContainer" class="commentContainer mt-5">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                {{-- comment start --}}
                                @foreach ($comments as $comment)
                                    @include('post.partial.comment')
                                @endforeach
                                {{-- comment end --}}
                            </div>
                            @empty($comments->toArray())
                                <i id="no-comment" class="text-grey">Be the first one to comment</i>
                            @endempty
                        </div>
                    </div>
                </div>
            
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

        .comment {
            background-color: rgba(231, 231, 193, 0.308);
        }

        .bi-trash-fill {
            cursor: pointer
        }

        .back-arrow {
            font-size: 2.5rem;
            font-weight:  bold;
            transition: all 0.1s ease-in-out;
            cursor: pointer
        }

        .back-arrow:hover {
            text-shadow: 0px 0px 15px rgba(128, 128, 128, 0.61)
        }

        .comment_profile_image {
            width: 2vw;
            border: 1px solid black;
            margin-right: 0.5em;
            border-radius: 50%
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

    @if (session('user_id'))
        function comment() {
            input_element = $("#input_comment");
            text = input_element.val();
            if (text.length <= 0) {
                return;
            }
            $.post({
                url: '{{ route('comment.add') }}',
                data: {
                    text: text,
                    post_id: {{ $post->id }}
                },
                success: function(response) {
                    $noComment = $('#no-comment')
                    if ($noComment.length) {
                        $noComment.remove();
                    }
                    $("#commentContainer").prepend(
                        '<div class="m-2 p-2 comment w-100" id="comment'+response+'"><h6 class="d-inline-block"><img class="comment_profile_image" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" alt="user">{{ $user -> first_name }} {{ $user -> last_name }}</h6> | 0 seconds <i class="ms-3 mt-2 d-inline-block bi bi-trash-fill text-danger" onclick=\'deleteComment('+response+')\'></i><hr> '+text+' </div>'
                    );

                    input_element.val("");
                    
                }
            })
        }




        function deleteComment(id) {

            if (!confirm("Delete this comment ?")){
                return;
            } 
            $.post({
                url: '{{ route('comment.delete') }}',
                data: {
                    comment_id: id
                },
                success: function(response) {
                    console.log(response);

                    commentE = $("#comment" + id);
                    commentE.remove();
                    
                    cont = $('.comment');
                    if (cont.length <= 0){
                        $('#commentContainer').append('<i id="no-comment" class="text-grey">Be the first one to comment</i>')
                    }
                }
            })
        }


        $('#input_comment').on('keypress', function(e) {
            if (e.which == 13) {
                comment()
            }
        });

    @endif
    </script>
@endsection