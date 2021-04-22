<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Route::get(
    '/dashboard',
    function () {
        return view('dashboard');
    }
)->middleware(['auth'])->name('dashboard');

Route::get(
    '/articles-create',
    function () {
        return view('articles/articles-create');
    }
)->middleware(['auth'])->name('dashboard.articles-create');

Route::get('/articles/list', [ArticleController::class, 'listArticles'])->middleware(['auth'])->name(
    'dashboard.articles-list'
);
Route::get('/articles/{articleId}', [ArticleController::class, 'getArticle'])->middleware(['auth']);

Route::get('/articles-categories', [CategoryController::class, 'all'])
    ->middleware(['auth'])->name('dashboard.articles-categories');

require __DIR__ . '/auth.php';
