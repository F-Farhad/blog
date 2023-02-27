<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\Category;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::firstOrCreate(['email'=> $data['email']], $data); //создаем нового пользователя или возвращаем если уже есть. То есть заботимся о том что бы
                                                                    //пользователи были уникальными

                                        //Так выглядит полная работа данного метода с указанием 2 массивов
        //$category = Category::firstOrCreate(['title' => $data['title']], ['title' => $data['title']]);
            // Первый массив определяем по каким ключам стоит проверять уникальность. Если title не уникален, то он вернет, обьект
            // существующий в бд. Во втором массиве указываются все атрибуты по которым будет создана запись в бд, указывается обязательно
            // https://www.youtube.com/watch?v=FMpJ8-5pnUQ&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=8
            // 5 минута
        return redirect()->route('admin.user.index');
    }
}
