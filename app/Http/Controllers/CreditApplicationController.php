<?php

namespace App\Http\Controllers;

use App\Mail\ShipCreditAppMail;
use App\Mail\StorCreditAppMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CreditApplicationController extends Controller
{
    public function apply(){

        return view('credit.creditapp');
    }


    public function shipcreditsubmit(){
        $data = request()-> validate([
            'name' => 'required',
            'billingaddress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'biz-type' => 'required',
            'biz-phone' => 'required',
            'id-num' => 'required',
            'num-employees' => 'required',
            'biz-rev' => 'required',

            'biz-years' => 'required',
            'biz-industry' => 'required',
            'biz-category' => 'required',
            'biz-type' => 'required',
            'biz-phone' => 'required',
            'id-num' => 'required',
            'num-employees' => 'required',
            'biz-specific' => 'required',
            'quote' => '',


        ]);


        //Send Email
        Mail::to('ship@fillstorship.com')->send(new ShipCreditAppMail($data));

        //return redirect('contact')->with('message', "Thanks for your message. We'll be in touch");
    }

    public function storcreditsubmit(){
        $data = request()-> validate([
            'name' => 'required',
            'billingaddress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'biz-type' => 'required',
            'biz-phone' => 'required',
            'id-num' => 'required',
            'num-employees' => 'required',
            'biz-rev' => 'required',

            'biz-years' => 'required',
            'biz-industry' => 'required',
            'biz-category' => 'required',
            'biz-type' => 'required',
            'biz-phone' => 'required',
            'id-num' => 'required',
            'num-employees' => 'required',
            'biz-specific' => 'required',
            'quote' => '',


        ]);


        //Send Email
        Mail::to('ship@fillstorship.com')->send(new StorCreditAppMail($data));

        //return redirect('contact')->with('message', "Thanks for your message. We'll be in touch");
    }

}


