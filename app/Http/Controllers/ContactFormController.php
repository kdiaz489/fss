<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Rules\Captcha;

class ContactFormController extends Controller
{
    public function create(){
        return view('contact.create');
    }

    public function store(){
        $data = request()-> validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => new Captcha()
        ]);
        
        //Send Email
        Mail::to('ship@fillstorship.com')->send(new ContactFormMail($data));

        return redirect('contact')->with('message', "Thanks for your message. We'll be in touch.");
    }
}
