<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CollectionController extends Controller
{

    function showDifference()
    {
        $var1 = City::query()->inRandomOrder()->limit(30)->get();
        dump($var1);// результат у вигляді - Illuminate\Database\Eloquent\Collection
                    // тобто колекція екзамплярів класу City
        $var2 = DB::table('cities')->limit(10)->get();
        dump($var2);// Illuminate\Support\Collection
        $var3 = DB::select('select * from cities order by RAND() limit 10');
        dump($var3);// масив даних

        //оскільки $var1 є колекцією, маємо доступ до її методів
        dump($var1->avg('population') . ' ' . 'середня к-ть населення');
        dump($var1->max('population'));
        dump($var1->min('population'));
        dump($var1->sum('population'));

        //фільтруємо дані.
        $filtered = $var1->filter(function ($value, $key) {
            return $value->population > 90_000;
        });
        dump($filtered->toArray());

        //вибірка разом з країною. В цьому випадку беруться всі дані з таблиці country
        $var4 = City::with('country')->inRandomOrder()->limit(30)->get();
        dump($var4->toArray());

        //в цьому тільки поле name
        $var5 = City::with(['country' => function ($query) {
            $query->select('id', 'name');
        }])->inRandomOrder()->limit(30)->get();
        dump($var5->toArray());

    }

    function relations(): View
    {
       // $post = Post::query()->find(1);
       // $tags = $post->tags;
       // dump($tags->toArray());

        $allPosts = Post::with('tags')->get();
        foreach ($allPosts as $post) {
            echo "{$post->title}<br>";
            foreach ($post->tags as $tag) {
                echo "{$tag->title}<br>";
            }
            echo "<hr>";
        }
        return view('home.index');
    }
}
