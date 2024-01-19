<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
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

Route::get('/home', [HomeController::class, 'index'])->name('root');

Auth::routes();

Route::get('/video-recipes', [HomeController::class, 'video_recipes'])->name('video_recipes');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/rules', [HomeController::class, 'rules'])->name('rules');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/contanct', [HomeController::class, 'contact'])->name('contact');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipe.show');
Route::get('/recipes', [HomeController::class, 'recipes'])->name('recipes');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('user', UserController::class);
    Route::resource('recipe', RecipeController::class)->except('show');
    Route::resource('/admin/category', CategoryController::class);
       Route::get('/admin/users/all', [UserController::class, 'users_admin'])->name('user.users_admin');
    Route::get('/admin/category/{category}/delete', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('/users/{user}/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/recipes/{recipe}/delete', [RecipeController::class, 'destroy'])->name('recipe.delete');

});



