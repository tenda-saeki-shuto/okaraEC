<?php


use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserLikeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::get('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

Route::get('/contact/submit', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::post('/contact/submit', [ContactController::class, 'submitForm'])->name('contact.submit');

// contact-> ユーザー用
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
// Route::match(['get', 'post'], [ContactController::class, 'confirm'])->name('contact.confirm');

Route::get('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
// Route::match(['get', 'post'],[ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/contact/submit', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::post('/contact/submit', [ContactController::class, 'submitForm'])->name('contact.submit');

// inquiry-> 管理者用
Route::match(['get', 'post'], '/inquiry', [ContactController::class, 'index'])->name('inquiry');
// Route::get('/inquiry', [ContactController::class, 'index'])->name('inquiry');
// Route::post('/inquiry', [ContactController::class, 'index'])->name('inquiry.submit');
Route::get('/inquiry/detail/{inquiry}', [ContactController::class, 'show'])->name('inquiry.detail');


Route::get('/admin/item', [ItemController::class, 'create'])->name('admin.item.create');
Route::post('/admin/item', [ItemController::class, 'store'])->name('admin.item.store');

Route::get('/admin/item_list', [ItemController::class, 'index'])->name('admin.item.index');
Route::get('/admin/item/{item}/edit', [ItemController::class, 'edit'])->name('admin.item.edit');

Route::get('/admin/user', [ProfileController::class, 'index'])->name('admin.user.index');
Route::get('/admin/user/{user}/edit', [ProfileController::class, 'edit'])->name('admin.user.edit');

// カード情報入力
Route::get('enter_card_info', function () {
    return view('enter_card_info');
})->name('enter_card_info');


//初期で表示されている画面
Route::get('/', function () {
    return view('dashboard');
});

//ヘッダーからマイページに画面遷移←ログインしていない場合はログイン画面にリダイレクト
Route::middleware(['auth'])->group(function () {
    Route::get('/user', [ProfileController::class, 'show'])->name('view.mypage');
    Route::get('/user/edit', [ProfileController::class, 'edit'])->name('userinfo.edit');
    Route::patch('/user/edit', [ProfileController::class, 'update'])->name('userinfo.update');
});

//レシピ画面に遷移
Route::get('/recipes', [RecipeController::class, 'user_index'])->name('recipes');
//レシピフィルター
Route::get('/recipes/filter', [RecipeController::class, 'filter'])->name('recipes.filter');
// レシピ詳細
Route::get('/resipes/{id}', [RecipeController::class, 'show'])->name('recipe_detail');


//商品一覧表示
// 商品一覧
Route::get('/items', [ItemController::class, 'user_index'])->name('items');
// 商品一覧のフィルター
Route::get('/items/filter', [ItemController::class, 'filter'])->name('items.filter');
// 商品詳細
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item_detail');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // 決済情報入力画面を表示するためのルート
    Route::get('/insert_payment_info', [PaymentController::class, 'index'])->name('insert_payment');

    // 決済確認画面で「戻る」ボタンが押された際のルート
    Route::post('/insert_payment_info', [PaymentController::class, 'changePaymentInfo'])->name('back_to_insert_payment');

    // 決済情報入力から確認画面へ遷移するボタンが押された際のルート
    Route::post('/payment_confirm', [PaymentController::class, 'confirm'])->name('payment_confirm');


    // 決済情報入力で変更ボタンが押された際のルート
    Route::post('/validate_address', [PaymentController::class, 'validateAddress']);

    // 決済完了画面に飛ぶルート
    Route::get('/payment_complete', [PaymentController::class, 'showOrders'])->name('show_orders');
});



// カート画面を表示するためのルート
Route::get('cart', [CartController::class, 'index'])->name('cart');

// カート画面で削除が押された際のルート
Route::post('cart_item_delete/{id}', [CartController::class, 'delete'])->name('cart_item_delete');

// カートのajax
Route::post('/change_cart_count/{id}/{count}', [CartController::class, 'update']);

//カート登録
Route::post('/cat/add', [CartController::class, 'add'])->name('cart.add');





// お気に入り登録
Route::post('/favorite/toggle', [UserLikeController::class, 'toggle'])->middleware('auth');


// トップ画面のルート
Route::get('/top', function () {
    return view('top');
})->name('top');


//退会処理
Route::middleware(['auth'])->group(
    function () {
        Route::get('/withdrawal', function () {
            return view('user.withdrawal');
        })->name('withdraw');
    }
);
Route::middleware(['auth'])->group(
    function () {
        Route::post('/withdrawal/confirm', [UserController::class, 'withdrawal'])->name('withdrawal.confirm');
    }
);

//---クイズ画面---------------------------------------------------------------

Route::get('/quiz', [QuizController::class, 'user_index'])->name('user.quiz');

//クイズ結果画面
Route::post('/quiz/answer', [QuizController::class, 'answer'])->name('quiz.answer');

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
