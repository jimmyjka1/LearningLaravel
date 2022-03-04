<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }



    public function newUserForm(){
        return view('user.new');
    }


    public function createNewUser(Request $request){
        dd($request -> all());
    }
}
