<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';

    //разрешаем изменять данные в таблице
    protected $guarded = false;

    //поле для подсчитывания колличества лайков
    protected $withCount = ['likedUsers'];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * Тут идет связка поста с пользователем по таблице post_user_likes, т.к это не стандартная связка, то послу User::class, указывается связующая таблица, после
     * указывается foreign key данной модели(Post) в таблице post_user_likes далее указывается отношение, то есть по какому ключу будет идти связь с моделью User
     */
    public function likedUsers(){
        return $this->belongsToMany(User::class, 'post_user_likes', 'post_id', 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
