<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Illuminate\Support\Str;

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
            return redirect()->route('admin.home');
        }

        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    //logout user;
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('signinPage');
    }

    //this function will display email send form;
    public function displayResetPasswordForm(){
        return Inertia::render('User/Auth/forgot-password');
    }

    //this method will sent reset password link;
    public function store(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    //this method will display password reset form;
    public function reset(Request $request){
        return Inertia::render('User/Auth/reset-password', [
            'email'=>$request->email,
            'token' => $request->route('token'),
        ]);
    }

    //this method will update password;
    public function update(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('signinPage')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    

}
