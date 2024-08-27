<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::redirect('/auth/login', '/app/login')->name('login');

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'aboutUs')->name('about-us');
    Route::get('/pro', 'pro')->name('pro');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blog/{slug}', 'singleBlog')->name('blog.single');
    Route::get('/documents', 'documents')->name('documents');
    //Route::get('/register', 'register')->name('register');
});

Route::get('/files/private/{path}', [FileController::class, 'getFile'])->where('path', '.*')->middleware('auth')->name('files');
