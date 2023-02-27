<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, UpdateRequest $updateRequest)
    {
        $data = $updateRequest->validated();
        $user->update($data);

        return redirect()->route('admin.user.show', $user->id);
    }
}
