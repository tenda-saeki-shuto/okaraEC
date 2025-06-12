<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.admin_header');
    });
    Route::resource('quiz', QuizController::class);
    Route::resource('recipe', RecipeController::class);
    
    Route::resource('item', ItemController::class);
    Route::resource('user', ProfileController::class);
    
    // Route::get('/item', [ItemController::class, 'create'])->name('admin.item.create');
    // Route::post('/item', [ItemController::class, 'store'])->name('admin.item.store'); 
    
    // Route::get('/item_list', [ItemController::class, 'index'])->name('admin.item.index');
    // Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->name('admin.item.edit');
    
    // Route::get('/user', [ProfileController::class, 'index'])->name('admin.user.index');
    // Route::get('/user/{user}/edit', [ProfileController::class, 'edit'])->name('admin.user.edit');
});
