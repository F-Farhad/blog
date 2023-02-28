<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data= [];
        $data ['users'] = User::all()->count();
        $data ['categories'] = Category::all()->count();
        $data ['tags'] = Tag::all()->count();
        $data ['posts'] = Post::all()->count();
        
        return view('admin.main.index', compact('data'));
    }
}
