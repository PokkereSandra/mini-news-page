<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ArticleController::class, 'home'])->name('home');
Route::get('/most-commented', [ArticleController::class, 'mostCommented']);
Route::get('/article/{id}', [ArticleController::class, 'show']);
Route::get('/reload', [ArticleController::class, 'reloadCaptcha']);
Route::post('/article/{id}', [ArticleController::class, 'addComment']);
Route::get('/add-article', [ArticleController::class, 'showForm'])->middleware(['auth', 'verified']);
Route::post('/add-article', [ArticleController::class, 'addArticle'])->middleware(['auth', 'verified']);
Route::post('/articles-update/{id}', [ArticleController::class, 'editArticle'])->middleware(['auth', 'verified']);
Route::post('/articles-delete', [ArticleController::class, 'destroyArticle'])->middleware(['auth', 'verified']);
Route::post('/comment-update/{id}', [ArticleController::class, 'editComment'])->middleware(['auth', 'verified']);
Route::post('/comment-delete', [ArticleController::class, 'destroyComment'])->middleware(['auth', 'verified']);


require __DIR__ . '/auth.php';
