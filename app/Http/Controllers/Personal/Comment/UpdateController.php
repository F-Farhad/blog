<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Personal\Comment\UpdateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Comment $comment, UpdateRequest $updateRequest)
    {
        $data = $updateRequest->validated();
        $comment->update($data);

        return redirect()->route('personal.comment.index');
    }
}
