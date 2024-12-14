<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// ログイン必須のルーティング
Route::middleware('auth')->group(function () {
    // カテゴリー
    Route::prefix('/categories')->group(function () {
        Route::get('/top', [App\Http\Controllers\CategoryController::class, 'index'])->name('top');
        Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('create');
        Route::post('/create', [App\Http\Controllers\CategoryController::class, 'categoryRegister'])->name('categoryRegister');
    });
    // 商品
    Route::prefix('items')->group(function () {
        Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
        Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::post('/delete', [App\Http\Controllers\ItemController::class, 'delete']);
    });

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});