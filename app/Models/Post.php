<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int status
 */
class Post extends Model
{
    use HasFactory;

    //помилково назвав табицю "post", тому вказав на це тут
    protected $table = 'post';

    protected $fillable = ['title','content','slug', 'status'];

    public function  isPublished()
    {
        //Ця конструкція означає якщо status = 1(true) повертаємо - 'Published'. Інакше - 'Not Published'
        return $this->status ? 'Published' : 'Not Published';
    }
}
