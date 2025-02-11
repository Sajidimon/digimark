<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware(ValidAdmin::class)->group(function(){
    //dashboard home route
    Route::get('/admin/home', [DashboardController::class, 'index'])->name('admin.home');

    //dashboard category page route;
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/admin/create-category', [CategoryController::class, 'create'])->name('category.create');

    //dashboard category api route;
    Route::post('/create-category', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/delete-category/{categoryId}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{categoryId}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::patch('/update-category/{categoryId}', [CategoryController::class, 'update']);

    //dashboard product page route;
    Route::get('/admin/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/admin/create-product', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{productId}/edit', [ProductController::class, 'edit'])->name('product.edit');

    //dashboard product api route;
    Route::post('/create-product', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/delete-product/{productId}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::patch('/update-product/{productId}', [ProductController::class, 'update']);

    //dashboard services page route;
    Route::get('/admin/services', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/admin/create-service', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/service/{serviceId}/edit', [ServiceController::class, 'edit'])->name('service.edit');

    //dashboard service api route;
    Route::post('/create-service', [ServiceController::class, 'store'])->name('service.store');
    Route::delete('/delete-service/{serviceId}', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::patch('/update-service/{serviceId}', [ServiceController::class, 'update']);

    //dashboard order page route;
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('order.index');

    //dashboard order api route;
    Route::delete('/delete-order/{orderId}', [OrderController::class, 'destroy'])->name('order.destroy');


    //dashboard pages route;
    Route::get('/admin/pages', [PageController::class, 'index'])->name('page.index');
    Route::get('/admin/create-page', [PageController::class, 'create'])->name('page.create');
    Route::get('/page/{pageId}/edit', [PageController::class, 'edit'])->name('page.edit');

    //dashboard page api route;
    Route::post('/create-page', [PageController::class, 'store'])->name('page.store');
    Route::delete('/delete-page/{pageId}', [PageController::class, 'destroy'])->name('page.destroy');
    Route::patch('/update-page/{pageId}', [PageController::class, 'update']);

    //dashboard settings;
    Route::get('/admin/settings', [SettingController::class, 'create'])->name('displaySettings');
    Route::patch('/settings', [SettingController::class, 'store'])->name('store.settings');

});

Route::middleware('guest')->group(function () {

    //cart route;
    Route::get('/cart', [CartController::class, 'displayCart'])->name('displayCart');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    //user page route;
    Route::get('/signup', [UserController::class, 'signupPage'])->name('signupPage');
    Route::get('/signin', [UserController::class, 'signinPage'])->name('signinPage');

    //reset password;
    Route::get('/forgot-password', [UserController::class, 'displayResetPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [UserController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [UserController::class, 'reset'])->name('password.reset');

    Route::post('/reset-password', [UserController::class, 'update'])->name('password.update');

});

//frontend home route;
Route::get('/', [HomeController::class, 'index'])->name('home');

//frontend single page view;
Route::get('/{slug}', [PageController::class, 'show'])->name('singlePage');

//single product route;
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('singleProduct');

//frontend single category view;
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('singleCategory');

//single service route;
Route::get('/service/{slug}', [ServiceController::class, 'show'])->name('singleService');

Route::post('/cart/add', [CartController::class, 'store'])->name('storeCart');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('destroyCart');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('clearCart');

//checkout route;
Route::post('/checkout', [CheckoutController::class, 'store'])->name('placeOrder');

//admin api route;
Route::post('/admin-register', [AdminController::class, 'adminRegister'])->name('adminRegister');
Route::post('/admin-login', [AdminController::class, 'adminLogin'])->name('adminLogin');
Route::post('/admin-logout', [AdminController::class, 'adminLogout'])->name('adminLogout');

//admin page route;
Route::get('/admin/register', [AdminController::class, 'registerPage'])->name('registerPage');
Route::get('/admin/login', [AdminController::class, 'loginPage'])->name('loginPage');

//user api route;
Route::post('/signup', [UserController::class, 'signUp'])->name('signUp');
Route::post('/signin', [UserController::class, 'signIn'])->name('signIn');
Route::post('/user-logout', [UserController::class, 'logout'])->name('logout');