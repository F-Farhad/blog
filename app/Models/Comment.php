<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    //разрешаем изменять данные в таблице
    protected $guarded = false;

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /*
    геттеры в ларавер именование должно быть по правилам:
        1. Надо с ger
        2. Оканчивается Attribute
    вызывается после просто по имени без указания выше перечисленный частей имени DateAsCarbon
    */
    public function getDateAsCarbonAttribute(){
        return Carbon::parse($this->created_at);
    }
}
