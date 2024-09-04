<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dump ('Hello World');
    dump(config('database.connections.sqlite')); //метод config дозволяє діставати дані з папки - larave.learn/config/...
    dump(config('myconfigexample.myconfig_1')); // зразок нового конфіг файлу
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

/*
 * маршрут, який приймає параметр name і виводить "Hello, {name}!",
 * де {name} – значення параметра. Наприклад, /greet/John має виводити "Hello, John!".
 */
Route::get('/greet/{name}', function ($name) {
    return "Hello {$name}";
});


/*
 * маршрут, який приймає необов'язковий параметр name і виводить "Hello, {name}!" або "Hello, Guest!",
 * якщо параметр не передано. Наприклад, /greet має виводити "Hello, Guest!".
 */
Route::get('/greet/{name?}', function ($name = 'guest') {
    return "Hello {$name}";
});
/*
 *  маршрут /submit, який приймає дані за допомогою методу POST і повертає повідомлення "Form submitted!".
 */




