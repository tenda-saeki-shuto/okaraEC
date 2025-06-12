<?php

namespace App\Http\Controllers;
use App\Models\Inquiries;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function showForm()
    {
        return view('user.contact_input');
    }
    public function confirm(Request $request)
    {
        $contactData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'tel' => 'required|digits_between:10,11',
        'inquiry' => 'required',
    ], [
        'name.required' => '※名前は必須です。',
        'email.required' => '※メールアドレスを入力してください。',
        'email.email' => '※有効なメールアドレス形式で入力してください。',
        'tel.required' => '※電話番号を入力してください。',
        'tel.digits_between' => '※電話番号は10～11桁で入力してください。',
        'inquiry.required' => '※お問い合わせ内容は必須です。',
    ]);

        return view('user.contact_confirm', compact('contactData'));
    }

    public function submitForm(Request $request)
    {


        Inquiries::create([
            'name' => $request['name'],
            'Email' => $request['email'],
            'tel' => $request['tel'],
            'inquiry' => $request['inquiry'],
        ]);
//        dd($contactData);
 
//        $all=Inquiries::all();
        
        return view('user.contact_submit');
    }

}
