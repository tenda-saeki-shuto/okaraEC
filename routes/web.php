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
use App\Http\Controllers\UserCouponController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


// トップ画面のルート
Route::get('/', function () {
    return view('top');
})->name('top');

// 注文履歴
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');


// contact-> ユーザー用
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');

Route::get('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm.post');

Route::get('/contact/submit', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::post('/contact/submit', [ContactController::class, 'submitForm'])->name('contact.submit.post');

// inquiry-> 管理者用
Route::match(['get', 'post'], '/inquiry', [ContactController::class, 'index'])->name('inquiry');
Route::get('/inquiry/detail/{inquiry}', [ContactController::class, 'show'])->name('inquiry.detail');


// Route::get('/admin/item', [ItemController::class, 'create'])->name('admin.item.create');
// Route::post('/admin/item', [ItemController::class, 'store'])->name('admin.item.store');

// Route::get('/admin/item_list', [ItemController::class, 'index'])->name('admin.item.index');
// Route::get('/admin/item/{item}/edit', [ItemController::class, 'edit'])->name('admin.item.edit');

// Route::get('/admin/user', [ProfileController::class, 'index'])->name('admin.user.index');
// Route::get('/admin/user/{user}/edit', [ProfileController::class, 'edit'])->name('admin.user.edit');

// カード情報入力
Route::get('enter_card_info', function () {
    return view('enter_card_info');
})->name('enter_card_info');

//初期で表示されている画面
// Route::get('/', function () {
//     return view('dashboard');
// });

//----------------------マイページ----------------------------------------------
//ヘッダーからマイページに画面遷移←ログインしていない場合はログイン画面にリダイレクト
Route::middleware(['auth'])->group(function () {
    Route::get('/user', [ProfileController::class, 'show'])->name('view.mypage');
    Route::get('/user/edit', [ProfileController::class, 'edit'])->name('userinfo.edit');
    Route::patch('/user/edit', [ProfileController::class, 'update'])->name('userinfo.update');
    Route::get('/user/like', [UserLikeController::class, 'index'])->name('user.like'); //お気に入り一覧
    Route::get('/user/coupon', [UserCouponController::class, 'index'])->name('user.coupon'); //クーポン一覧
});

//--------------------------------------------------------------------------

//-----------------レシピ--------------------------------------------------------
//レシピ画面に遷移
Route::get('/recipes', [RecipeController::class, 'user_index'])->name('recipes');
//レシピフィルター
Route::get('/recipes/filter', [RecipeController::class, 'filter'])->name('recipes.filter');
// レシピ詳細
Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipe_detail');

//-------------------------------------------------------------------------------

//----------------------商品一覧表示--------------------------------------------------
// 商品一覧
Route::get('/items', [ItemController::class, 'user_index'])->name('items');
// 商品一覧のフィルター
Route::get('/items/filter', [ItemController::class, 'filter'])->name('items.filter');
// 商品詳細
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item_detail');
// お気に入り登録
Route::post('/favorite/toggle', [UserLikeController::class, 'toggle'])->middleware('auth');

//-----------------------------------------------------------------------------------


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//-----------------------決済関係--------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // カート画面で「購入手続きへ」ボタンが押された際に、決済情報入力画面を表示するためのルート
    Route::get('/insert_payment_info', [PaymentController::class, 'index'])->name('insert_payment');

    // 決済情報確認画面で「戻る」ボタンが押されたときのルート
    Route::get('/insert_payment_info/revise', [PaymentController::class, 'changePaymentInfo'])->name('revise_insert_payment');

    // カード情報入力画面の表示
    Route::get('enter_card_info', function () {
        return view('enter_card_info');
    })->name('enter_card_info');

    // カード情報入力画面で「完了」ボタンが押された際のルート
    Route::post('/insert_payment_info', [PaymentController::class, 'registerCard'])->name('register_card');

    // 決済情報入力で「注文確認」ボタンが押された際のルート
    Route::post('/payment_confirm', [PaymentController::class, 'confirm'])->name('payment_confirm');

    // 決済情報入力で「選択を外す」ボタンが押された際のルート
    Route::post('/unuse_coupon', [PaymentController::class, 'unuseCoupon'])->name('unuse_coupon');

    // 決済情報入力で変更ボタンが押された際のルート
    Route::post('/validate_address', [PaymentController::class, 'validateAddress']);

    // 決済完了画面に飛ぶルート
    Route::get('/payment_complete', [PaymentController::class, 'showOrders'])->name('show_orders');

    // 決済完了画面で「トップへ戻る」を押した際のルート
    Route::post('/payment_done', [PaymentController::class, 'donePayment'])->name('done_payment');
});


//-----------------カート----------------------------------------------------------
// カート画面を表示するためのルート
Route::get('cart', [CartController::class, 'index'])->name('cart');

// カート画面で削除が押された際のルート
Route::post('cart_item_delete/{id}', [CartController::class, 'delete'])->name('cart_item_delete');

// カートのajax
Route::post('/change_cart_count_ajax', [CartController::class, 'ajaxUpdate']);

// 商品画面でカート内の数量が変更された際のルート
Route::post('/change_cart_count/{id}', [CartController::class, 'update'])->name('cart.update');

//カート登録
Route::post('/cat/add', [CartController::class, 'add'])->name('cart.add');

//---------------------------------------------------------------------------------


//---クイズ画面---------------------------------------------------------------

// お気に入り登録
Route::post('/favorite/toggle', [UserLikeController::class, 'toggle'])->middleware('auth');
Route::get('/quiz', [QuizController::class, 'user_index'])->name('user.quiz');

//クイズ結果画面
Route::post('/quiz/answer', [QuizController::class, 'answer'])->name('quiz.answer');

//過去のクイズ
Route::get('/quiz/past/{id}', [QuizController::class, 'past_index'])->name('quiz.past');
Route::post('/quiz/past_answer', [QuizController::class, 'past_answer'])->name('past.answer');

//----------------------------------------------------------------------------


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
