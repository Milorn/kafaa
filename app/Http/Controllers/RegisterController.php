<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register\RegisterRequest;

class RegisterController extends Controller
{
    public function registerPage()
    {
        return view('pages/register');
    }

    public function register(RegisterRequest $request)
    {
        return 'ok';
    }
}
