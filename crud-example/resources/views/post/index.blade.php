@extends('layout.master')

@section('title', 'All Users')


@section('content')
    <div class="d-flex flex-column flex-wrap justify-content-center align-items-center ">
        @forelse ($posts as $post)
            @include('post.partial.post_item')
        @empty
            <h2>No Posts Found</h2>
        @endforelse

        
    </div>

    <style>
        .bi.bi-heart, .bi.bi-heart-fill {
            cursor: pointer;
            color: red;
        
        }

        .card {
            transition: all 0.5s ease-in-out;
            cursor: default;
        }

        .card:hover {
            box-shadow: 0px 0px 15px rgba(128, 128, 128, 0.692);
        }

        .like-btn-container {
            margin-top: 8rem;
        }

        a.blog-title {
            text-decoration: none;
            color: black
        }
        a.blog-title:hover {
            text-decoration: underline;
        }

    </style>

    <script>
        function likePost(id){
            $button = $('#like-button-' + id);
            if ($button.hasClass('bi-heart')){
                $.post({
                    url: "{{ route('like_post.like') }}",
                    data:  {
                        post_id: id
                    },
                    success: function($response){
                        $('#like-count-' + id).text($response);
                        $button.removeClass('bi-heart');
                        $button.addClass('bi-heart-fill');
                    }
                });
            } else {
                $.post({
                    url: "{{ route('like_post.dislike') }}",
                    data:  {
                        post_id: id
                    },
                    success: function($response){
                        $('#like-count-' + id).text($response);
                        $button.removeClass('bi-heart-fill');
                        $button.addClass('bi-heart');
                    }
                })
            }
        }

        
    </script>
@endsection

