<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Данный контроллер отвязывает посты от пользователей тем самым удаляя лайки.
     * 
     */
    public function __invoke(Post $post)
    {
        auth()->user()->likedPosts()->detach($post->id);
        
        return redirect()->route('personal.liked.index');
    }
}
