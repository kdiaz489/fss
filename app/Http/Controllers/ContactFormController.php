<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Rules\Captcha;

class ContactFormController extends Controller
{
    public function create(){
        return view('contact.create');
    }
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function store(){
        $data = request()-> validate([
            'name' => ['required', 'string','max:225'],
            'email' => ['required','string','email','max:225'],
            'message' => ['required','string'],
            'g-recaptcha-response' => ['required', new Captcha()]
        ]);
        
        
        //Send Email
        Mail::to('ship@fillstorship.com')->send(new ContactFormMail($data));

        return redirect('contact')->with('message', "Thanks for your message. We'll be in touch.");
    }
}
