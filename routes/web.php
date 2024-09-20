<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SingleTestController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dump ('Hello World');
    dump(config('database.connections.sqlite')); //метод config дозволяє діставати дані з теки - laravel.learn/config/...
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
    return "Hello $name";
});

/*
 * маршрут, який приймає необов'язковий параметр name і виводить "Hello, {name}!" або "Hello, Guest!",
 * якщо параметр не передано. Наприклад, /greet має виводити "Hello, Guest!".
 */
Route::get('/greet/{name?}', function ($name = 'guest') {
    return "Hello $name";
});
/*
 * маршрут /submit, котрий приймає дані за допомогою методу POST і повертає повідомлення "Form submitted!".
 * для тесту краще використовувати postman
 * виникає помилка 419. тому цей запит потрібно вимкнути з валідації csrf
 */
Route::post('/submit', function () {
   return 'Form Submitted';
})->withoutMiddleware(VerifyCsrfToken::class);

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
Route::prefix('hello')->group(function () {
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

/*
 * Використовую хелпер route() для генерації URL і повертаю його як відповіді з іншого маршруту /get-contact-url.
 * Використовую іменований маршрут contact для цього.
 */
Route::get('/get-contact-url', function () {
    return route('contact');
});

/*
 * маршрут /user/{id}, де параметр id повинен бути числом. регулярний вираз для обмеження параметра.
 */
Route::get('/user/{id}', function ($id) {
    return "User ID: $id";
})->where('id', '[0-9]+');

/*
 * маршрут /username/{name}, де параметр name повинен складатися тільки з букв.
 */
Route::get('/username/{name}', function ($name) {
    return "Username: $name";
})->where('name', '[A-Za-z]+');

/*
 * ---------------------------------- далі йдуть приклади з використанням контроллерів----------------------------------
 */

/*
 * Цей рядок робить наступне:
 * Route::get('/') — визначає маршрут для HTTP-запиту GET на головну сторінку (/).
 * [HomeController::class, 'index'] — вказує, що при запиті на цей маршрут буде викликано метод index з контролера HomeController.
 * ->name('home') — присвоює цьому маршруту ім'я home для зручного використання в коді (наприклад, для генерації посилань або перенаправлень).
 */
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/full_info', [HomeController::class, 'getAllInfoAboutUsers'])->name('fullInfo');
Route::get('/single', SingleTestController::class); //можна вказувати шлях до класу без імпорту
Route::post('/store', [HomeController::class,'store'])->withoutMiddleware(VerifyCsrfToken::class);
Route::post('/update', [HomeController::class,'update'])->withoutMiddleware(VerifyCsrfToken::class);

/*
 * групування ендпоінтів по префіксу та імені
 */
Route::prefix('admin')->name('admin.')->group(function ()
{
    Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // name->admin.products.index
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store')
    ->withoutMiddleware(VerifyCsrfToken::class);
    Route::get('/products/{product}/show', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

/*
 * Цей код виконує всі маршрути попередньої групи
 * але це не явний і не гнучкий спосіб, тому потрібно бути уважним
 * можна налаштовувати за допомогою методів except і only
 * Route::resource('posts', PostController::class)->except(['create', 'show']);
 * Route::resource('posts', PostController::class)->only(['show']);
 */
Route::resource('posts', PostController::class);

Route::get('/dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');

Route::get('/cities',[\App\Http\Controllers\CollectionController::class, 'showDifference' ]);
