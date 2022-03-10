<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likes = Like::select(DB::raw('post_id, count(*) as count')) ->  groupBy('post_id') -> get() -> keyBy('post_id') ;
        // dd($likes -> toArray());
        $current_user_like = Like::where('user_id', session() -> get('user_id')) -> get() -> keyBy('post_id');
        $posts = Post::get();
        return view('post.index', ['posts' => $posts, 'likes' => $likes, 'current_user_like' => $current_user_like]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::get();
        return view('post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {   
        $validated = $request -> validated();
        
        if (!session() -> has('user_id')){
            return redirect() -> route('user.login');
        } 

        $post = Post::make($validated);
        $post -> user_id = session('user_id');
        $post -> save();
        return redirect() -> route('post.show', ['post' => $post -> id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $user_id = session() -> get('user_id');
        $current_user = Like::where('user_id', $user_id) -> where('post_id', $post -> id) -> count();
        $like_count = Like::where('post_id', $post -> id) -> count();

        
        return view('post.show', ['post' => $post, 'current_user' => $current_user, 'like_count' => $like_count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user_id = session() -> get('user_id');
        if ($user_id != $post -> user_id){
            abort(404);
        }
        $categories = Category::get();
        return view('post.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, Post $post)
    {
        $user_id = session() -> get('user_id');
        if ($user_id != $post -> user_id){
            abort(404);
        }
        $post -> fill($request -> validated());
        $post -> save();
        return redirect() -> route('post.show', ['post' => $post -> id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   

        abort_if(session() -> get('user_id') != $post -> user_id, 404 );
        $post -> delete();
        return redirect() -> route('post.index');
    }
}
