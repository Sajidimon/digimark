<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{

    /**
     * Show the form for creating a new user.
     */
    public function registerPage()
    {

        return Inertia::render('Admin/Auth/Register');
    }

    public function loginPage()
    {
        return Inertia::render('Admin/Auth/Login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function adminRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:3'
        ]);

         User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'admin',  // Assign admin role
        ]);

    }

    //this method is for admin login;
    public function adminLogin(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials) && Auth::user()->role == 'admin'){
            $request->session()->regenerate();
        }else{
            return back()->withErrors([
                'email' => 'you are not an admin.',
            ]);
        }
    }

    //admin logout;

    public function adminLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

}
