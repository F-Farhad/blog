<?php

use App\Http\Controllers\Admin\Main\IndexController;
use App\Http\Controllers\Main\MainIndexController;
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

Route::group(['namespace' => 'App\Http\Controllers\Main'], function(){
    Route::get('/', MainIndexController::class);
});

Route::group(['namespace' => 'App\Http\Controllers\Admin\Main', 'prefix' => 'admin'], function(){
    Route::get('/', IndexController::class);
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
