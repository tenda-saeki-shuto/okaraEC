<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


//レシピ登録画面に遷移する
Route::get('/admin/recipes_create', function(){
    return view('admin.recipes_create');
});

//ヘッダー画面のみ表示
Route::get('/user/user_header', function(){
    return view('user.user_header');
});

//マイページ画面の表示
Route::get('/user/mypage', function(){
    return view('user.mypage');
});

//管理者側テストヘッダー
Route::get('/admin/test', function(){
    return view('admin.test');
});

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
