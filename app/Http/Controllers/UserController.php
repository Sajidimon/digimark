<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    //this method will display user signup page;
    public function signupPage(){
        return Inertia::render('User/Auth/Signup');
    }

    //this method will register user;
    public function signUp(Request $request){
        $user = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:3'
        ]);

        User::create($user);
    }

    //this method will display user signup page;
    public function signinPage()
    {
        return Inertia::render('User/Auth/Signin');
    }

    //this method will signin user;
    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }

        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    

}
