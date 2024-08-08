<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages/home');
    }

    public function aboutUs()
    {
        return view('pages/about-us');
    }
}
