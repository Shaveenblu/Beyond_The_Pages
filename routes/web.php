<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/article', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/article/create',[ArticleController::class, 'create'])->name('articles.create');
Route::post('/article',[ArticleController::class, 'store'])->name('articles.store');
Route::get('/article/{article}/edit',[ArticleController::class, 'edit'])->name('articles.edit');
Route::get('/article/{article}',[ArticleController::class, 'show'])->name('articles.show');
Route::put('/article/{article}/update',[ArticleController::class, 'update'])->name('articles.update');
Route::delete('/article/{article}/destroy',[ArticleController::class, 'destroy'])->name('articles.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('articles', ArticleController::class);
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
