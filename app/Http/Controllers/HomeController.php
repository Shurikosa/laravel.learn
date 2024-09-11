<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected array $users;
    protected string $homePageTitle;
    protected string $contactPageTitle;
    protected string $testPageTitle;

    public function __construct()
    {
        /*
         * users - витягуємо через - file_get_contents. Декодуємо json_decode -
         * true як другий параметр перетворює дані в асоціативий масив
         */
        /*
         * ще один спосіб який робить те саме. З бабліотеки Laravel
         * $users = Http::get('https://jsonplaceholder.typicode.com/posts')->json();
         */
        $this->users = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/users'), true);
        $this->homePageTitle = 'Home page';
        $this->contactPageTitle = 'Contact page';
        $this->testPageTitle = 'Test page';
    }

    function index(): View
    {

        return view('home.index',  [
            'users' => $this->users,
            'title' => $this->homePageTitle
        ]);// можна передавати безліч даних
    }
    function test(): View
    {
        return view('home.test', [
            'users' => $this->users,
            'title' => $this->testPageTitle
        ]);
    }
    function contact(): View
    {
        //dump($this->users);
        return view('home.contact', [
            'users' => $this->users,
            'title' => $this->contactPageTitle
        ]);
    }

}
