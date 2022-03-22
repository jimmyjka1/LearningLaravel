<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return view('users.index');
        $num_rows = $request -> input('num_rows', 10);
        
        $users = User::sortable('id') -> paginate($num_rows) -> withQueryString();

        return view('users.index', compact(
            'users',
            'num_rows'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $validated = $request -> validated();
        $user = new User();
        $user -> name = $validated['name'];
        $user -> email = $validated['email'];
        $user -> password = Hash::make($validated['password']);
        $user -> save();
        return redirect() -> route('users.show', ['user' => $user ->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request -> validated();
        $user -> name = $validated['name'];
        $user -> email = $validated['email'];
        $user -> save();
        return redirect() -> route('users.show', ['user' => $user ->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user -> id  != Auth::user() -> id){
            $user -> delete();
        }
        return redirect() -> route('users.index');
    }


    public function show_role(User $user){
        $roles = Role::all();
        return view('users.role', compact(
            'user',
            'roles'
        ));
    }
}
