<?php

namespace App\Http\Controllers\Traits;

use App\Models\QuizSelections;
use App\Models\QuizStatus;
use App\Models\UserCoupon;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

trait HandlesGuestQuiz
{
    public function handleGuestQuizAfterLogin()
    {
        if (!session()->has('guest_quiz_id') || !session()->has('guest_selection_id')) {
            return;
        }

        $user = Auth::user();
        $quiz_id = session('guest_quiz_id');
        $selection_id = session('guest_selection_id');
        $is_answer = session('guest_is_answer');

        $alreadyAnswered = QuizStatus::where('quizzes_id', $quiz_id)
            ->where('user_id', $user->id)
            ->exists();

        if (!$alreadyAnswered) {
            $selection = QuizSelections::find($selection_id);

            QuizStatus::create([
                'quizzes_id' => $quiz_id,
                'user_id' => $user->id,
                'is_clear' => $is_answer
            ]);

            if ($selection && $selection->is_answer === 1) {
                $coupon = Coupon::find(2);
                $now = Carbon::now();
                $base_day = $now->day;
                $two_months_later = $now->copy()->addMonths(2);
                $valid_at = $base_day > $two_months_later->daysInMonth
                    ? $two_months_later->endOfMonth()
                    : $two_months_later->day($base_day);

                UserCoupon::create([
                    'user_id' => $user->id,
                    'coupon_id' => $coupon->id,
                    'valid_at' => $valid_at
                ]);

                //セッションにクイズでクーポンを発行したことを保存
                session()->flash('coupon_quiz', 'クイズ正解おめでとうございます<br>クーポンを獲得しました');
            }
        }

        session()->forget(['guest_quiz_id', 'guest_selection_id']);
    }
}
