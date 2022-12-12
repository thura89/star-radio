<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;

use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\EventsController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\NobleController;
use App\Http\Controllers\Backend\OthersNewsController;
use App\Http\Controllers\Backend\AdsController;
use App\Http\Controllers\Backend\SliderController;

Route::get('/locale/{lange}', [LocalizationController::class,'setlang']);

Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    
    // Blogs
    Route::resource('/blogs', BlogController::class);

    // News
    Route::resource('/news', NewsController::class);
    
    // other News
    Route::resource('/other_news', OthersNewsController::class);

    // Event
    Route::resource('/events', EventsController::class);

    // Noble
    Route::resource('/nobles', NobleController::class);

    // ADS
    Route::resource('/ads', AdsController::class);

    // ADS
    Route::resource('/sliders', SliderController::class);

    

    
});
