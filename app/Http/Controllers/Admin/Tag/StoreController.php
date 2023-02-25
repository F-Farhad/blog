<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        Tag::firstOrCreate($data); //создаем новую категорию или возвращаем если уже есть. То есть заботимся о том что бы
                                        //имена были уникальнымиS

                                        //Так выглядит полная работа данного метода с указанием 2 массивов
        //$category = Category::firstOrCreate(['title' => $data['title']], ['title' => $data['title']]);
            // Первый массив определяем по каким ключам стоит проверять уникальность. Если title не уникален, то он вернет, обьект
            // существующий в бд. Во втором массиве указываются все атрибуты по которым будет создана запись в бд, указывается обязательно
            // https://www.youtube.com/watch?v=FMpJ8-5pnUQ&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=8
            // 5 минута
        return redirect()->route('admin.tag.index');
    }
}
