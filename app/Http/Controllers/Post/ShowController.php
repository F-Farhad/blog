<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {                                                   //Класс Carbon следует локализовать, что бы вывод был на русском, это делается App/Providers/AppServiceProvider Carbon::setLocale('ru_Ru');
        $date = Carbon::parse($post->created_at);       //Данный класс используется для работы с датой. Это отдельная библиотека, но она уже встроена в laravel
        $relatedPost = Post::where('category_id', $post->category_id) //получаем схожие посты по категориям
        ->where('id', '!=', $post->id)
        ->get()
        ->take(3);
        return view('post.show', compact('post', 'date', 'relatedPost'));
    }
}
