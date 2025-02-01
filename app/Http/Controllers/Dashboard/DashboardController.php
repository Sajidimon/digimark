<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //this method will display dashboard page;
    public function index(){
        return Inertia::render('Admin/Home');
    }
}
