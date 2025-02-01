<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/home', [DashboardController::class, 'index'])->name('admin.home');
