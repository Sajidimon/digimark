<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware(ValidAdmin::class)->group(function(){
    Route::get('/admin/home', [DashboardController::class, 'index'])->name('admin.home');
});


//admin api route;
Route::post('/admin-register', [AdminController::class, 'adminRegister'])->name('adminRegister');
Route::post('/admin-login', [AdminController::class, 'adminLogin'])->name('adminLogin');
Route::post('/admin-logout', [AdminController::class, 'adminLogout'])->name('adminLogout');

//admin page route;
Route::get('/admin/register', [AdminController::class, 'registerPage'])->name('registerPage');
Route::get('/admin/login', [AdminController::class, 'loginPage'])->name('loginPage');

//user page route;
Route::get('/signup', [UserController::class, 'signupPage'])->name('signupPage');
Route::get('/signin', [UserController::class, 'signinPage'])->name('signinPage');

//user api route;
Route::post('/signup', [UserController::class, 'signUp'])->name('signUp');
Route::post('/signin', [UserController::class, 'signIn'])->name('signIn');