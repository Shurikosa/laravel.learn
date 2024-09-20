<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Post;
use Illuminate\Http\Request;
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
    protected $citiesList;

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
        $this->citiesList  = DB::select('select * from cities');
        $this->homePageTitle = 'Home page';
        $this->contactPageTitle = 'Contact page';
        $this->fullInfoPageTitle = 'Full information page';
    }

    function index(): View
    {

        /*
         *  вибирає всі міста, де населення більше 10 мільйонів.
         *  Метод where() дозволяє додати умову до запиту,
         * а get() отримує всі записи, що відповідають цій умові.
         */
        $cities = City::where('population', '>', 10000000)->get();
        dump($cities);

        /*
         *Цей запит вибирає всі міста, де поле capital має значення 'primary', тобто є столицями.
         * $cities = City::where('population', '>', 1000000)->get();
         */
        //$cities = City::query()->where('population', '>', 10000000)->count(); виводить результативне число
        $cities = City::query()->where('population', '>', 10000000)->get()->toJson();
        dump($cities);


        /* виводимо 404 якщо запису немає
         * $country404 = Country::query()->find('AFG2');
        if(!$country404){
           abort(404);
        }
            робить те саме, тільки коротшим записом
          $country404 = Country::query()->findOrFail('AFG2');
        */

        //спосіб запису даних в бд
        $post = new Post();
        $post->title = 'Post 4';
        $post->content = 'Post 4 content';
        dump($post->save());


        return view('home.index',  [
            'users' => $this->users,
            'title' => $this->homePageTitle
        ]);// можна передавати безліч даних
    }

    //Що один спосіб - це обробник post запиту. тут ми ловимо реквест і записуємо ці дані в бд
    public function store(Request $request){
        Post::query()->create($request->all());// таким чином ми додаємо одразу всі дані, але баз валідації
        return $request->all();                //але таким чиом ми заповнюємо таблицю масово, і для цього в сутності
    }                                          //потрібне поле $fillable

    // ще один спосіб запису в бд. Тут ми вказуємо точно які саме дані будуть оновлені
    public function update(Request $request)
    {
        $post = Post::query()->find($request->id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = $request->status;
        $post->save();
        //або таким чином
        /*
         * $post = Post::query()->findOrFail($request->id);
         * $post->update($request->all());
        */
        return 'OK';
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
