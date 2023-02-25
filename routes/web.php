<?php

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
    Route::get('/', IndexController::class);
});

Route::namespace('\App\Http\Controllers\Admin')->prefix('admin')->group(function(){
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
});



    // Route::group(['namespace' => 'App\Http\Controllers\Admin\Category', 'prefix'=>'categories'], function(){
        
    // });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
