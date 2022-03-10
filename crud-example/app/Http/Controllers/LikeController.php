<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    function like(Request $request){
        
        $user_id = session() -> get('user_id');
        $post_id = $request -> post_id;
        $p = Like::where('user_id', $user_id) -> where('post_id', $post_id) -> get() -> count();
        if ($p != 0){
            return Like::where('post_id' , $post_id) -> get() -> count(); 
        }
        
        $like = new Like();
        $like -> user_id = $user_id;
        $like -> post_id = $post_id;
        $like -> save();

        return Like::where('post_id' , $post_id) -> get() -> count();
        // return "1";
        
    }

    function dislike(Request $request){
        $user_id = session() -> get('user_id');
        $post_id = $request -> post_id;
        
        $result = Like::where('post_id', $post_id) -> where('user_id', $user_id) -> delete();

        return Like::where('post_id' , $post_id) -> get() -> count();

    }

}
