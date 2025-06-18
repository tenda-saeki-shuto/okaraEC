<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Prefecture;

class ProfileController extends Controller
{
    // ユーザープロフィール編集画面表示メソッド
    // ファイル: resources/views/profile/edit.blade.php を表示
    public function edit(Request $request)
    {
        $prefecture = Prefecture::all(); // 都道府県一覧取得
        return view('profile.edit', [
            'user' => $request->user(),
            'prefecture' => $prefecture,
        ]);
    }

    // ユーザー情報更新処理メソッド
    // バリデーションルールと日本語メッセージをここに記載（追記箇所）
    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:7', 'max:20'],
            'postal_code' => ['required', 'digits:7'], //郵便番号
            'prefecture_id' => ['required', 'exists:prefectures,id'],  // 都道府県
            'address' => ['required'], //住所
            'tel' => ['required', 'regex:/^\d{10,11}$/']
        ]);


        $validated = $request->validate($rules);
        // ユーザー情報の更新処理
        $user = $request->user(); // ログイン中のユーザーを取得
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->tel = $validated['tel'];

        $user->save(); // ユーザー本体を保存

        // ユーザーの住所情報の更新（リレーションがある場合）
        $user->address->postal_code = $validated['postal_code'];
        $user->address->prefecture_id = $validated['prefecture_id'];
        $user->address->address = $validated['address'];
        $user->address->save(); // 住所情報を保存

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * 新規追加メソッド：パスワード変更専用
     * バリデーションのエラーバッグ名を 'updatePassword' に指定している（追記）
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'], // 現パスワード確認
            'password' => ['required', 'string', 'min:7', 'max:20', 'confirmed'], // 新パスワード
        ], [
            'current_password.required' => '現在のパスワードは必須です。',
            'current_password.current_password' => '現在のパスワードが正しくありません。',
            'password.required' => '新しいパスワードは必須です。',
            'password.min' => '新しいパスワードは7文字以上で入力してください。',
            'password.max' => '新しいパスワードは20文字以内で入力してください。',
            'password.confirmed' => '新しいパスワードが一致しません。',
        ], [], 'updatePassword'); // ← ここでエラーバッグ名を指定しているのがポイント

        // パスワード更新処理
        $user = $request->user();
        $user->password = bcrypt($request->password);
        $user->save();

        return Redirect::back()->with('status', 'password-updated');
    }

    /**
     * アカウント削除処理メソッド
     * バリデーションはエラーバッグ名 'userDeletion' を指定
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'min:7', 'max:20', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // ユーザーマイページ表示メソッド
    public function show()
    {
        $user = Auth::user()->load([
            'address.prefecture' // ネストされたリレーションの一括読み込み
        ]);

        // パスワードは表示せずにmypageビューへ
        return view('user.mypage', compact('user'));
    }
}
