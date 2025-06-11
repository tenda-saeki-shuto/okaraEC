<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::resource('quiz', QuizController::class);
    Route::resource('recipe', RecipeController::class);
});

