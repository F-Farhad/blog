<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    //разрешаем изменять данные в таблице
    protected $guarded = false;

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
