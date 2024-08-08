<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::redirect('/auth/login', '/app/login')->name('login');

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'aboutUs')->name('about-us');
    Route::get('/pro', 'pro')->name('pro');
    Route::get('/resources', 'resources')->name('resources');
});
