<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Laravel';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }

    public function contactus(){
        $data = array(
            'title' => 'Contact FillStorShip',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.contactus')->with($data);
    }
}

