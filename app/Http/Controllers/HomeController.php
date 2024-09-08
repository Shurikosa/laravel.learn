<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{

    function index(): View
    {
        return view('home.index', ['title' => 'Home page']);// можна передавати безліч даних
    }
    function test(): View
    {
        return view('home.test', ['title' => 'Test page']);
    }
    function contact(): View
    {
        return view('home.contact', ['title' => 'Contact page']);
    }
}
