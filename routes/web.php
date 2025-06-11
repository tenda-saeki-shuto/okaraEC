<?php


use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

//初期で表示されている画面
Route::get('/', function () {
    return view('dashboard');
});

//ヘッダーからマイページに画面遷移←ログインしていない場合はログイン画面にリダイレクト
Route::middleware(['auth'])->group(function () {
    Route::get('/user', [ProfileController::class, 'show'])->name('view.mypage');
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


Route::get('/admin/quiz_create', function () {
    return view('admin.quiz_create');
})->name('quiz.create');

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



// //レシピ登録画面に遷移する
// Route::get('/admin/recipes_create', function(){
//     return view('admin.recipes_create');
// });



// //マイページ画面の表示
// Route::get('/user/mypage', function(){
//     return view('user.mypage');
// });

// //管理者側テストヘッダー
// Route::get('/admin/test', function(){
//     return view('admin.test');
// });