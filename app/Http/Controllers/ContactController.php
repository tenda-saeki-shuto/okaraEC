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
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'tel' => ['required', 'digits_between:10,11'],
            'inquiry' => ['required', 'max:200'],
        ]);

        $contactData = $request->only(['name', 'email', 'tel', 'inquiry']);

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

    public function index()
    {
        $inquiry_list= Inquiries::all();
        return view('admin.inquiry_index', compact('inquiry_list')); 
    }

    public function show(Inquiries $inquiry)
    {
           return view('admin.inquiry_detail', compact('inquiry')); 
    }
}
