<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int status
 */
class Post extends Model
{
    use HasFactory;

    //помилково назвав табицю "post", тому вказав на це тут
    protected $table = 'post';

    protected $fillable = ['title','content','slug', 'status'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function  isPublished()
    {
        //Ця конструкція означає якщо status = 1(true) повертаємо - 'Published'. Інакше - 'Not Published'
        return $this->status ? 'Published' : 'Not Published';
    }
}
