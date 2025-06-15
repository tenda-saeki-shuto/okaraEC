<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'create'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'store']);
    });
    Route::middleware('auth:admin')->group(function () {
        // 管理ログアウト
        Route::delete('/login', [AdminLoginController::class, 'destroy'])->name('admin.login.destroy');
        // 管理トップ
        Route::get('/', function () {
            return view('admin.top');
        })->name('admin.top');

        // 管理クイズ
        Route::resource('quiz', QuizController::class);
        // 管理レシピ
        Route::resource('recipe', RecipeController::class);
        // 管理商品
        Route::resource('item', ItemController::class);
        // 管理ユーザー
        Route::resource('user', UserController::class);
    });


    // Route::get('/', function () {
    //     return view('admin.admin_header');
    // });

    // Route::get('/user', [ProfileController::class, 'index'])->name('admin.user.index');
    // Route::get('/user/{user}/edit', [ProfileController::class, 'edit'])->name('admin.user.edit');
});
