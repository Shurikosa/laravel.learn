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
 * маршрут /submit, котрий приймає дані за допомогою методу POST і повертає повідомлення "Form submitted!".
 * для тесту краще використовувати postman
 * виникає помилка 419. тому цей запит потрібно вимкнути з валідації csrf
 */
Route::post('/submit', function () {
   return 'Form Submitted';
})->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

/*
 * маршрут /update, який використовує метод PUT і повертає повідомлення "Data updated!".
 */
Route::put('/update', function () {
   return 'Form Updated';
});

/*
 * маршрут /delete, який використовує метод DELETE і повертає повідомлення "Data deleted!".
 */
Route::delete('/delete', function () {
    return 'Form Deleted';
});

/*
 * група маршрутів з префіксом admin.
 * У цій групі додай маршрут /dashboard, який повертає "Admin Dashboard",
 * і маршрут /settings, який повертає "Admin Settings".
 */
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Here must be admin dashboard view';
    });
    Route::get('/settings', function () {
        return 'Here must be admin settings view';
    });
});
/*
 * маршрут /contact, який повертає текст "Contact Page" де ми задаємо ім'я маршруту - contact.
 * contact — це ім'я маршруту, яке ви використовуєте для посилань або перенаправлень у вашому додатку.
 * Підсумок:
 * URL (/contact) визначає, де в браузері буде доступний маршрут.
 * Ім'я маршруту (->name('contact')) — це зручний спосіб посилатися на цей маршрут у коді,
 * що робить його більш гнучким і легким для обслуговування.
 * Приклад для розуміння
 *Якщо ви хочете згенерувати посилання на сторінку контакту в якомусь шаблоні або контролері,
 *замість того щоб писати /contact у вашому коді, ви пишете:
 * route('contact')
 */
Route::get('/contact', function () {
    return 'Contact Page';
})->name('contact');

