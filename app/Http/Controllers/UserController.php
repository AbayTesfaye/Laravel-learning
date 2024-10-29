<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\SeekerRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createSeeker(){
        return view('users.seeker-registery');
    }

    public function createEmployer(){
        return view('users.employer-registery');
    }


    public function storeSeeker(SeekerRegistrationRequest $request){
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')), // Use bcrypt to hash the password
            'user_type' => "Seeker",
        ]);

        return back();
    }

      // login user
     public function login(){
       return view('users.login');
   }

   public function postLogin(Request $request){
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required']
    ]);

    $credantials = $request->only('email','password');
    if(Auth::attempt($credantials)){
        return redirect()->intended('dashboard');
    }

    return "Wrong email or Password";
 }

 public function logout(){
    Auth::logout();
    return redirect()->route('login');
 }

}
