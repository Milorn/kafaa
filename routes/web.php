<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ViewDataController;
use Illuminate\Support\Facades\Route;

Route::redirect('/auth/login', '/app/login')->name('login');

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'aboutUs')->name('about-us');
    Route::get('/pro', 'pro')->name('pro');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blog/{slug}', 'singleBlog')->name('blog.single');
    Route::get('/documents', 'documents')->name('documents');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'registerPage')->name('register-page');
    Route::post('/register', 'register')->name('register');
});

Route::controller(ViewDataController::class)->prefix('/data')->group(function () {
    Route::get('/activity-areas', 'activityAreas')->name('data.activity-areas');
});

Route::get('/files/private/{path}', [FileController::class, 'getFile'])->where('path', '.*')->middleware('auth')->name('files');
