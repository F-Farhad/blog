<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post, UpdateRequest $updateRequest)
    {
        $data = $updateRequest->validated();
        $tag_ids = $data['tag_ids'];                                                                        //https://www.youtube.com/watch?v=YfqXlvFtgIk&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=21
            unset($data['tag_ids']);                    //сохранять картинки следует в папку storage/public, после данную папку следует расшарить в папку public, для этого создается ссылка на папку storage php artisan storage:link 
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);   //https://www.youtube.com/watch?v=oCwP0PsHmUk&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=17
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            $post->update($data);
            $post->tags()->sync($tag_ids);  //метод sync удаляет все привязки которые есть у модели и создает новые, которые ему передают

        return redirect()->route('admin.post.show', $post->id);
    }
}
