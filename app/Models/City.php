<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    // Додаємо назву таблиці (за замовчуванням таблиця називається cities)
    //тому це поле створювати не обов'язково.
    protected $table = 'cities';

    // Поля, які можна заповнювати
    protected $fillable = ['name', 'ascii_name', 'population', 'admin_name', 'capital', 'lng', 'lat', 'country_id'];

    // Зв'язок з моделлю Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
