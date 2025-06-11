<?php


use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
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

Route::get('/admin/item', [ItemController::class, 'create'])->name('admin.item.create');
Route::post('/admin/item', [ItemController::class, 'store'])->name('admin.item.store'); // 保存処理

//商品一覧表示
Route::get('/items', function () {
    return view('user.items');
});
// 商品詳細表示下
Route::get('/item_detail', function () {
    return view('user.item_detail');
})->name('item_detail');
// Route::get('/item/{id}', [ItemController::class, 'show'])->name('item_detail');


Route::get('enter_card_info', function () {
    return view('enter_card_info');
})->name('enter_card_info');

Route::get('enter_card_info', function(){
    return view('enter_card_info');
})->name('enter_card_info');

Route::get('cart', [CartController::class, 'index'])->name('cart');

Route::post('cart_item_delete/{id}', [CartController::class, 'delete'])->name('cart_item_delete');

// カートのajax
Route::post('/change_cart_count/{id}/{count}', [CartController::class, 'update']);

Route::get('confirm_payment', function(){
    return 'Hello';
})->name('confirm_payment');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
