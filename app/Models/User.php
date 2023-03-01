<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\SendVerifyWithQueueNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 0;
    const ROLE_READER = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public static function getRoles(){
        return [
            self::ROLE_ADMIN => 'Админ',
            self::ROLE_READER => 'Читатель',
        ];
    }  

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new SendVerifyWithQueueNotification());
    }

    /**
     * Если связующая таблица идет не стандартная, т.е. не по правилам Laravel, в это случае она указывается вторым аргументам, 
     * 3 и 4 аргумент уточняет по каким полям свзывать posts и users(проверял работает и без них, но указывать не стандартную табилцу обязательно иначе он будет искать post_user)
     */
    public function likedPosts(){   
        return $this->belongsToMany(Post::class, 'post_user_likes', 'user_id', 'post_id');
    }
}
