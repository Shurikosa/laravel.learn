<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected array $users;
    protected array $usersFromBD;
    protected string $homePageTitle;
    protected string $contactPageTitle;
    protected string $fullInfoPageTitle;

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
        $this->usersFromBD = DB::select('select * from users');
        $this->homePageTitle = 'Home page';
        $this->contactPageTitle = 'Contact page';
        $this->fullInfoPageTitle = 'Full information page';
    }

    function index(): View
    {

        return view('home.index',  [
            'users' => $this->users,
            'title' => $this->homePageTitle
        ]);// можна передавати безліч даних
    }

    function contact(): View
    {
        //dump($this->users);
        return view('home.contact', [
            'users' => $this->users,
            'title' => $this->contactPageTitle
        ]);
    }

    function getAllInfoAboutUsers(): View

        /**
         * огляд фасаду DB:: та транзакцій
         *
         */
    {
        /*try {
           DB::transaction(function () {
               DB::insert("insert into users (name, email, password) VALUES (?, ?, ?)", ['d\'Arc', 'darc@mail.com', 555]);
               DB::insert("insert into users (name, email, password) VALUES (?, ?, ?)", ['d\'Arc', 'darc2@mail.com', 555]);
           });
       } catch (\Exception $exeption) {
           dump($exeption->getMessage());
       }*/

        try {
            DB::beginTransaction();
            DB::insert("insert into users (name, email, password) VALUES (?, ?, ?)", ['d\'Arc', 'darc@mail.com', 555]);
            DB::insert("insert into users (name, email, password) VALUES (?, ?, ?)", ['d\'Arc', 'darc2@mail.com', 555]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dump($exception->getMessage());
        }
        return view('home.full_info', [
            'users' => $this->usersFromBD,
            'title' => $this->fullInfoPageTitle
        ]);
    }

}
