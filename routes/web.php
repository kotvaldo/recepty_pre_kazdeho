<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('root');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('root');

Auth::routes();

Route::get('/recepty', [App\Http\Controllers\HomeController::class, 'recipes'])->name('recipes');
Route::get('/video-recepty', [App\Http\Controllers\HomeController::class, 'video_recipes'])->name('video_recipes');
Route::get('/o-nas', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

Route::group(['middleware' => ['auth']], function() {Route::resource('user', UserController::class);});
