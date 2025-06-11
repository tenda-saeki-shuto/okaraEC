<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLike;
use Illuminate\Support\Facades\Log;


class UserLikeController extends Controller
{
    public function toggle(Request $request)
    {
        Log::info('toggleメソッド開始');

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
}
