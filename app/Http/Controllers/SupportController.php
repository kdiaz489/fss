<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function termsofuse(){
        return view('support.termsofuse');
    }

    public function privacypolicy(){
        return view('support.privacypolicy');
    }

    public function returnpolicy(){
        return view('support.returnpolicy');
    }
}
