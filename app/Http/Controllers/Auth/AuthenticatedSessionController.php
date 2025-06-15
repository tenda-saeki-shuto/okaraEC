<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Models\UserCoupon;
use App\Http\Controllers\Traits\HandlesGuestQuiz;


class AuthenticatedSessionController extends Controller
{
    use HandlesGuestQuiz;

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        //ゲストクイズ処理
        $this->handleGuestQuizAfterLogin();

        //リダイレクト位置（クイズから来た場合はquizに、それ以外はトップに）
        $redirect = session('redirect_after_login', route('top'));
        session()->forget('redirect_after_login');

        //クーポンで有効期限が切れたものを削除
        $user_id = Auth::user()->id;
        $now = Carbon::now();//今の日付
        //ユーザーが持つクーポンで期限切れのものは削除
        UserCoupon::where('user_id', $user_id)
            ->where('valid_at', '<', $now)
            ->delete();


        return redirect($redirect);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
