<?php

namespace App\Http\Controllers;

use App\Mail\FilRequestAppMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FulfillmentRequestsController extends Controller
{
    public function apply(){

        return view('credit.creditapp');
    }


    public function store(){
        $data = request()-> validate([
            'co-name' => 'required',
            'contact-name' => 'required',
            'contact-email' => 'required|email',
            'contact-phone' => 'required',
            'product-name' => 'required',
            'product-type' => 'required',
            'quantity' => 'required',
            'desc' => 'required',
        ]);


        //Send Email
        Mail::to('ship@fillstorship.com')->send(new FilRequestAppMail($data));

        //return redirect('contact')->with('message', "Thanks for your message. We'll be in touch");
    }
}
