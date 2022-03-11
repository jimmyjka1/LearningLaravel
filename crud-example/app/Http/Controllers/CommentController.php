<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function add_comment(Request $request){
        $request -> validate([
            'post_id' => 'required|numeric',
            'text' => 'required|max:200'
        ]);

        $comment = new Comment();
        $comment -> user_id = session('user_id');
        $comment -> post_id = $request -> post_id;

        $comment -> comment = $request -> text;
        $comment -> save();

        return $comment -> id;
    }

    function delete_comment(Request $request){
        $request -> validate([
            'comment_id' => 'required|numeric'
        ]);

        $comment = Comment::findOrFail($request -> comment_id);
        abort_if(session() -> get('user_id') != $comment -> user_id, 404);
        $comment -> delete();
    }
}
