<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'postal_code' => ['required', 'regex:/^\d{7}$/'], //郵便番号
            'prefecture_id' => ['required', 'exists:prefectures,id'],  // 都道府県
            'address' => ['required', 'max:30'], //住所
            'tel' => ['required', 'regex:/^\d{11}$/'], //電話番号
        ];
    }
}
