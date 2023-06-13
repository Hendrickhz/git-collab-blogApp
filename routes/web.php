<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('page.index');
    Route::get('/article-detail/{slug}', 'show')->name('page.show');
    Route::get('/category/{slug}', 'categorized')->name('page.categorized');
});

Auth::routes();

Route::middleware(['auth'])->prefix('dashboard')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('article', ArticleController::class);
    Route::resource('category', CategoryController::class)->except('show');
    Route::get('/user-list', [HomeController::class, 'users'])->name('users')->can('admin-only');
});



Route::resource('category', CategoryController::class);

Route::resource('comment', CommentController::class)->only([
    "store", "update", "destroy",
]);

