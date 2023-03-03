<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::namespace('\App\Http\Controllers\Main')->group(function(){
    Route::get('/', IndexController::class)->name('main.index');
});

Route::namespace('\App\Http\Controllers\Post')->prefix('posts')->group(function(){
   Route::get('/', IndexController::class)->name('post.index');
   Route::get('/{post}', ShowController::class)->name('post.show');
});

Route::namespace('\App\Http\Controllers\Personal')->prefix('personal')->middleware('auth','admin')->group(function(){
   Route::namespace('Main')->group(function(){
      Route::get('/', IndexController::class)->name('personal.main.index');
   }); 

   Route::namespace('Liked')->prefix('liked')->group(function(){
      Route::get('/', IndexController::class)->name('personal.liked.index');
      Route::delete('/{post}', DeleteController::class)->name('personal.liked.destroy');
   });

   Route::namespace('Comment')->prefix('comment')->group(function(){
      Route::get('/', IndexController::class)->name('personal.comment.index');
      Route::get('/{comment}/edit', EditController::class)->name('personal.comment.edit');
      Route::patch('/{comment}', UpdateController::class)->name('personal.comment.update');
      Route::delete('/{comment}', DestroyController::class)->name('personal.comment.destroy');
   });
});

Route::namespace('\App\Http\Controllers\Admin')->prefix('admin')->middleware('auth','admin', 'verified')->group(function(){
   Route::namespace('Main')->group(function(){
       Route::get('/', IndexController::class)->name('admin.index');
   });

     Route::namespace('Category')->prefix('categories')->group(function(){
        Route::get('/', IndexController::class)->name('admin.category.index');
        Route::get('/create', CreateController::class)->name('admin.category.create');
        Route::post('/', StoreController::class)->name('admin.category.store');
        Route::get('/{category}', ShowController::class)->name('admin.category.show');
        Route::get('/{category}/edit', EditController::class)->name('admin.category.edit');
        Route::patch('/{category}', UpdateController::class)->name('admin.category.update');
        Route::delete('/{category}', DestroyController::class)->name('admin.category.destroy');
     });

     Route::namespace('Tag')->prefix('tags')->group(function(){
        Route::get('/', IndexController::class)->name('admin.tag.index');
        Route::get('/create', CreateController::class)->name('admin.tag.create');
        Route::post('/', StoreController::class)->name('admin.tag.store');
        Route::get('/{tag}', ShowController::class)->name('admin.tag.show');
        Route::get('/{tag}/edit', EditController::class)->name('admin.tag.edit');
        Route::patch('/{tag}', UpdateController::class)->name('admin.tag.update');
        Route::delete('/{tag}', DestroyController::class)->name('admin.tag.destroy');
     });

     Route::namespace('Post')->prefix('posts')->group(function(){
        Route::get('/', IndexController::class)->name('admin.post.index');
        Route::get('/create', CreateController::class)->name('admin.post.create');
        Route::post('/', StoreController::class)->name('admin.post.store');
        Route::get('/{post}', ShowController::class)->name('admin.post.show');
        Route::get('/{post}/edit', EditController::class)->name('admin.post.edit');
        Route::patch('/{post}', UpdateController::class)->name('admin.post.update');
        Route::delete('/{post}', DestroyController::class)->name('admin.post.destroy');
     });

     Route::namespace('User')->prefix('users')->group(function(){
        Route::get('/', IndexController::class)->name('admin.user.index');
        Route::get('/create', CreateController::class)->name('admin.user.create');
        Route::post('/', StoreController::class)->name('admin.user.store');
        Route::get('/{user}', ShowController::class)->name('admin.user.show');
        Route::get('/{user}/edit', EditController::class)->name('admin.user.edit');
        Route::patch('/{user}', UpdateController::class)->name('admin.user.update');
        Route::delete('/{user}', DestroyController::class)->name('admin.user.destroy');
     });
});



    // Route::group(['namespace' => 'App\Http\Controllers\Admin\Category', 'prefix'=>'categories'], function(){
        
    // });

 Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
