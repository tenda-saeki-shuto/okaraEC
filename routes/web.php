<?php


use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserLikeController;
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
Route::post('/admin/item', [ItemController::class, 'store'])->name('admin.item.store');

Route::get('/admin/item_list', [ItemController::class, 'index'])->name('admin.item.index');
Route::get('/admin/item/{item}/edit', [ItemController::class, 'edit'])->name('admin.item.edit');

Route::get('/admin/user', [ProfileController::class, 'index'])->name('admin.user.index');
Route::get('/admin/user/{user}/edit', [ProfileController::class, 'edit'])->name('admin.user.edit');


//商品一覧表示
// 商品一覧
Route::get('/items', [ItemController::class, 'user_index'])->name('items');
// 商品一覧のフィルター
Route::get('/items/filter', [ItemController::class, 'filter'])->name('items.filter');



// 商品詳細
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item_detail');





// カード情報入力
Route::get('enter_card_info', function () {
    return view('enter_card_info');
})->name('enter_card_info');


// カート画面を表示するためのルート
Route::get('cart', [CartController::class, 'index'])->name('cart');

// カート画面で削除が押された際のルート
Route::post('cart_item_delete/{id}', [CartController::class, 'delete'])->name('cart_item_delete');

// カートのajax
Route::post('/change_cart_count/{id}/{count}', [CartController::class, 'update']);

//カート登録
Route::post('/cat/add', [CartController::class, 'add'])->name('cart.add');


Route::get('confirm_payment', function () {
    return 'Hello';
})->name('confirm_payment');


// 決済情報入力画面を表示するためのルート
Route::get('insert_payment_info', [PaymentController::class, 'index'])->name('insert_payment');

// 決済情報入力から確認画面へ遷移するボタンが押された際のルート
// Route::post('payment_confirm', [PaymentController::class, 'confirm'])->name('payment_confirm');

// 決済情報入力で変更ボタンが押された際のルート
Route::post('/validate_address', [PaymentController::class, 'validateAddress']);

// お気に入り登録
Route::post('/favorite/toggle', [UserLikeController::class, 'toggle'])->middleware('auth');







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
