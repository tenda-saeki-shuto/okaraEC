<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::resource('quiz', QuizController::class);
});



// Route::resource('play', GameController::class);
// Route::get('/check', [GameController::class, 'receiveDB'])->name('room_status_check');


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/admin/quiz_create', function () {
//     return view('admin.quiz_create');
// })->name('quiz.create');


