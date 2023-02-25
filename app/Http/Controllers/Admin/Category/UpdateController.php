<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category, UpdateRequest $updateRequest)
    {
        $data = $updateRequest->validated();
        $category->update($data);

        return redirect()->route('admin.categories.show', $category->id);
    }
}
