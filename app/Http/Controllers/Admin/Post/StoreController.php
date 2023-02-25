<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        try{
            $data = $request->validated();
            $tag_ids = $data['tag_ids'];
            unset($data['tag_ids']);
            $data['preview_image'] = Storage::put('/images', $data['preview_image']);   //https://www.youtube.com/watch?v=oCwP0PsHmUk&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=17
            $data['main_image'] = Storage::put('/images', $data['main_image']);
            $post = Post::firstOrCreate($data); //создаем новую категорию или возвращаем если уже есть. То есть заботимся о том что бы
                                            //имена были уникальными
            $post->tags()->attach($tag_ids);
                                            //Так выглядит полная работа данного метода с указанием 2 массивов
            //$category = Category::firstOrCreate(['title' => $data['title']], ['title' => $data['title']]);
                // Первый массив определяет по каким ключам стоит проверять уникальность. Если title не уникален, то он вернет, обьект
                // существующий в бд. Во втором массиве указываются все атрибуты по которым будет создана запись в бд, указывается обязательно
                // https://www.youtube.com/watch?v=FMpJ8-5pnUQ&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=8
                // 5 минута
        }catch(Exception $exception){
            abort(404);
        }
        
        return redirect()->route('admin.post.index');
    }
}
