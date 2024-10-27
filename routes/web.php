<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ViewDataController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::redirect('/auth/login', '/app/login')->name('login');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        Route::controller(PagesController::class)->group(function () {
            Route::get('/', 'home')->name('home');
            Route::get('/about-us', 'aboutUs')->name('about-us');
            Route::get('/pro', 'pro')->name('pro');
            Route::get('/blog', 'blog')->name('blog');
            Route::get('/blog/{slug}', 'singleBlog')->name('blog.single');
            Route::get('/documents', 'documents')->name('documents');
            Route::get('/equipments', 'equipments')->name('equipments');
            Route::get('/equipments/{slug}', 'singleEquipment')->name('equipments.single');
            Route::get('/experts', 'experts')->name('experts');
            Route::get('/experts/{expert}', 'singleExpert')->name('experts.single');
            Route::get('/charter', 'charter')->name('charter');
        });

        Route::get('/register', [RegisterController::class, 'registerPage'])->name('register-page');
    }
);

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::controller(ViewDataController::class)->prefix('/data')->group(function () {
    Route::get('/activity-areas', 'activityAreas')->name('data.activity-areas');
    Route::get('/wilayas', 'wilayas')->name('data.wilayas-areas');
});

Route::get('/files/private/{id}/{path}', [FileController::class, 'getFile'])->where('path', '.*')->middleware('auth')->name('files');
Route::get('/equipments/{slug}/download', [PagesController::class, 'downloadEquipment'])->name('equipments.download');
