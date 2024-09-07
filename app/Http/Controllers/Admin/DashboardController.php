<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{

    public function index(): \Illuminate\View\View
    {
        $name = 'Lukas';
        $age = 45;
        $title = 'admin dashboard';
       return view('dashboard', compact('name', 'age', 'title'));
    }
}
