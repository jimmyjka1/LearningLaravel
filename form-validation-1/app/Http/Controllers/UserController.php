<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }



    public function newUserForm(){
        return view('user.new');
    }


    public function createNewUser(UserFormRequest $request){

        // $request -> validate([
        //     'first_name' => "required|regex:/^[A-Za-z\s]+$/u|max:255",
        //     'last_name' => "required|regex:/^[A-Za-z\s]+$/u|max:255",
        //     'email' => 'required|email|max:255',
        //     'phone' => 'required|digits_between:10,12',
        //     'password' => 'required|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@\^\&\*!$#%]).*$/u|min:6',
        //     'gender' => 'required',
        //     'cast' => 'required',
        //     'image_file' => 'mimes:jpg,jpeg,png|max:2048'
        // ], [
        //     'first_name.required' => "First Name is required",
        //     'first_name.regex' => "First Name should contain Alphabets and Spaces only",
        //     'last_name.required' => "Last Name is required",
        //     'last_name.regex' => "Last Name should contain Alphabets and Spaces only",
        //     'email.required' => "User Email Id is required",
        //     'email.email' => 'Please Enter Valid Email Id',
        //     'password.regex' => "Password should have at least one Upper, one lower case letter, at lease on digit, and one special character "
        // ]);
        
        $validated = $request -> validated();
        dd($validated);
    }
}
