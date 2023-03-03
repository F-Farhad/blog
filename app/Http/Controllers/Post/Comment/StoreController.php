<?php

namespace App\Http\Controllers\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post, StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();
        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $post->id;
        
        Comment::create($data);

        return redirect()->route('post.show', $post->id);
    }
}
