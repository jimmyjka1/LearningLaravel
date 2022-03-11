<div class="m-2 p-2 comment w-100" id="comment{{ $comment->comment_id }}">
    <h6 class="d-inline-block">{{ $comment->first_name }} {{ $comment->last_name }}</h6> |
    {{ $comment->updated_at->diffForHumans() }}

    @if (session('user_id') == $comment->user_id)
        <i class="ms-3 mt-2 d-inline-block bi bi-trash-fill text-danger"
            onclick="deleteComment({{ $comment->comment_id }})"></i>
    @endif

    <hr>
    {{ $comment->comment }}
</div>
