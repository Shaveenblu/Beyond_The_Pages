<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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
Route::put('/article/{article}/update',[ArticleController::class, 'update'])->name('articles.update');
Route::delete('/article/{article}/destroy',[ArticleController::class, 'destroy'])->name('articles.destroy');




//Route::get('/status', [StatusConbtroller::class, 'index'])->name('status.index');
//Route::get

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
