<?php

namespace App\Http\Controllers;

use App\Mail\StorCreditAppMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StorCreditApplicationController extends Controller
{
    public function apply(){

        return view('credit.creditapp');
    }


    public function store(){
        $data = request()-> validate([
            'name' => 'required',
            'email' => 'required|email',
            'billingaddress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'acc' => 'required',
            'date' => 'required',
            'card-type' => 'required',
            'cvc' => 'required',
            'quote' => '',


        ]);


        //Send Email
        Mail::to('ship@fillstorship.com')->send(new StorCreditAppMail($data));

        //return redirect('contact')->with('message', "Thanks for your message. We'll be in touch");
    }
}
