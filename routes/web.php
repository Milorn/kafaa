<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/auth/login', '/app/login')->name('login');

Route::get('/', fn () => view('home'));
