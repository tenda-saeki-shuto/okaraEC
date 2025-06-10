<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/items', function () {
    return view('user.items');
});
Route::get('/itemdetail', function () {
    return view('item_detail');
})->name('item_detail');
Route::get('/admin/quiz_create', function () {
    return view('admin.quiz_create');
})->name('quiz.create');

Route::get('enter_card_info', function(){
    return view('enter_card_info');
})->name('enter_card_info');


require __DIR__ . '/auth.php';
