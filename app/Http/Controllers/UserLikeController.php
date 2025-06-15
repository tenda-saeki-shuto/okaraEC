<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLike;
use Illuminate\Support\Facades\Log;


class UserLikeController extends Controller
{
    //お気に入り処理
    public function toggle(Request $request)
    {

        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $itemId = $request->json('item_id');

        if (!$itemId) {
            return response()->json(['error' => 'Invalid item ID'], 400);
        }

        $existing = UserLike::where('user_id', $user->id)
            ->where('item_id', $itemId)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['liked' => false]);
        } else {
            UserLike::create([
                'user_id' => $user->id,
                'item_id' => $itemId,
            ]);
            return response()->json(['liked' => true]); // または false
        }
    }

    //お気に入り画面表示
    public function index()
    {
        // ユーザー情報取得
        $user_id = Auth::id(); // より簡潔な書き方

        // ユーザーが「いいね」した item_id を取得
        $item_ids = UserLike::where('user_id', $user_id)->pluck('item_id');

        // 該当するアイテムを取得
        $items = Item::whereIn('id', $item_ids)->get();

        // 各アイテムに is_favorited フラグを追加
        foreach ($items as $item) {
            $item->is_favorited = UserLike::where('user_id', $user_id)
                ->where('item_id', $item->id)
                ->exists();
        }

        return view('user.like', compact('items'));
    }
}
