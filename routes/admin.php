<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.admin_header');
    });
    Route::resource('quiz', QuizController::class);
    Route::resource('recipe', RecipeController::class);
    
    Route::resource('item', ItemController::class);
    Route::resource('user', UserController::class);

    // Route::get('/user', [ProfileController::class, 'index'])->name('admin.user.index');
    // Route::get('/user/{user}/edit', [ProfileController::class, 'edit'])->name('admin.user.edit');
});
