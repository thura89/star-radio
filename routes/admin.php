<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdsController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Backend\AudioController;
use App\Http\Controllers\Backend\NobleController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\EventsController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProgramController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OthersNewsController;
use App\Http\Controllers\Backend\SongRequestController;

Route::get('/locale/{lange}', [LocalizationController::class,'setlang']);

Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Users
    Route::resource('/users', UsersController::class);
    Route::get('/users/{id}/reset', [UsersController::class,'reset'])->name('reset');
    
    Route::get('/change_password', [UsersController::class,'change_password'])->name('change_password');
    Route::post('/change-password', [UsersController::class, 'changePasswordSave'])->name('postChangePassword');
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

    // Slider
    Route::resource('/sliders', SliderController::class);

    // Category
    Route::resource('/categories', CategoryController::class);

    // Program
    Route::resource('/programs', ProgramController::class);

    // Audio
    Route::resource('/audios', AudioController::class);

    // Song Request
    Route::resource('/song_requests', SongRequestController::class);

    
    // About Us
    Route::get('/about', [DashboardController::class,'about'])->name('about');

    // Contact Us
    Route::get('/contact', [DashboardController::class,'contact'])->name('contact');

    // Contact Us
    Route::post('/blog/{id}/edit', [DashboardController::class,'blog_store'])->name('blog.store');

    
});
