<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
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

// Route::get('/admin/quiz_create', function () {
//     return view('admin.quiz_create');
// })->name('quiz.create');

// カード情報入力
Route::get('enter_card_info', function(){
    return view('enter_card_info');
})->name('enter_card_info');

// カート画面を表示するためのルート
Route::get('cart', [CartController::class, 'index'])->name('cart');

// カート画面で削除が押された際のルート
Route::post('cart_item_delete/{id}', [CartController::class, 'delete'])->name('cart_item_delete');

// カートのajax
Route::post('/change_cart_count/{id}/{count}', [CartController::class, 'update']);

Route::get('confirm_payment', function(){
    return 'Hello';
})->name('confirm_payment');

// 決済情報入力画面を表示するためのルート
Route::get('insert_payment_info', [PaymentController::class, 'index'])->name('insert_payment');

// 決済情報入力から確認画面へ遷移するボタンが押された際のルート
// Route::post('payment_confirm', [PaymentController::class, 'confirm'])->name('payment_confirm');

// 決済情報入力で変更ボタンが押された際のルート
Route::post('/validate_address', [PaymentController::class, 'validateAddress']);

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
