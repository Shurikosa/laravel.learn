<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    // Додаємо назву таблиці (за замовчуванням таблиця називається countries)
    protected $table = 'countries';

    // Поля, які можна заповнювати масово
    protected $fillable = ['iso2', 'iso3', 'name'];

    // Зв'язок один до багатьох з моделлю City
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
