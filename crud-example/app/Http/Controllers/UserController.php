<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserUpdateFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  index()
    {   
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function  store(UserFormRequest $request)
    {
        $validated = $request -> validated();
        $user = new User();
        $user -> first_name = $validated['first_name'];
        $user -> last_name = $validated['last_name'];
        $user -> email = $validated['email'];
        $user -> role_id = $validated['role_id'];
        $user -> password = $validated['password'];
        $user -> save();
        return redirect() -> route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user  = User::findOrFail($id);
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateFormRequest $request, $id)
    {
        $validated = $request -> validated();
        $user = User::findOrFail($id);

        $user -> fill($validated);

        $user -> save();
        return redirect() -> route('user.show', ['user' => $user -> id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user -> delete();
        return redirect() -> route("user.index");
    }

    
    public function loginPage(){
        return view('user.login');
    }

    public function login(Request $request){
        $request -> validate([
            'email' => "required",
            'password' => 'required'
        ]);

        $result = User::where('email', '=', $request -> email) -> where('password', '=', $request -> password) -> get();
        if ($result -> isEmpty()){
            session() -> flash('error', 'Incorrect email or password');
            return redirect() -> route('user.login');
        }

        session() -> put('user_id', $result[0] -> id);
        session() -> put('name', $result[0] -> first_name . " " . $result[0] -> last_name);
        return redirect() -> route('home');
    }


    public function logout(){
        session() -> forget('user_id');
        session() -> forget('name');
        return redirect() -> route('user.login_page');
    }
}
