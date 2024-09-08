<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // тут ми сворюємо меню яке можна вставити в будь-яке місце в шаблонах зі змінної $menu
        view()->composer('*', function (View $view) {
            $menu ='<ul>';
            $menu .='<li><a href="' . route('admin.products.index') . '">Home</a></li>';
            $menu .='<li><a href="' . route('admin.products.create') . '">Add Product</a></li>';
            $menu .='<li><a href="' . route('admin.products.store') . '">Orders</a></li>';
            $menu .='</ul>';
            $view->with('menu', $menu);
        });
    }
}
