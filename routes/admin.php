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
    Route::post('/news/removeall', [NewsController::class, 'removeall'])->name('news.removeall');
    
    // other News
    Route::resource('/other_news', OthersNewsController::class);
    Route::post('/other_news/removeall', [OthersNewsController::class, 'removeall'])->name('other_news.removeall');

    // Event
    Route::resource('/events', EventsController::class);

    // Noble
    Route::resource('/nobles', NobleController::class);
    Route::post('/nobles/removeall', [NobleController::class, 'removeall'])->name('nobles.removeall');

    // ADS
    Route::resource('/ads', AdsController::class);

    // Slider
    Route::resource('/sliders', SliderController::class);

    // Category
    Route::resource('/categories', CategoryController::class);

    // Program
    Route::resource('/programs', ProgramController::class);
    Route::post('/programs/audio', [ProgramController::class, 'uploadAudioFiles'])->name('audiofiles.upload.large');
    Route::post('/programs/removeall', [ProgramController::class, 'removeall'])->name('programs.removeall');

    // Audio
    Route::resource('/audios', AudioController::class);
    Route::get('/audios/live/{id}', [AudioController::class,'liveRadio'])->name('liveRadio');

    // Song Request
    Route::resource('/song_requests', SongRequestController::class);
    Route::post('/song_requests/delete', [SongRequestController::class,'destroy'])->name('song_requests.remove');
    Route::post('/song_requests/removeall', [SongRequestController::class, 'removeall'])->name('song_requests.removeall');

    
    // About Us
    Route::get('/about', [DashboardController::class,'blogs'])->name('about');

    // Contact Us
    Route::get('/contact', [DashboardController::class,'blogs'])->name('contact');

    // Daily Schedule
    Route::get('/daily_schedule', [DashboardController::class,'blogs'])->name('daily_schedule');

    /// blogsave
    Route::post('/blogsave', [DashboardController::class,'blog_store'])->name('blogsave');

    // Contact Us
    Route::post('/blog/{id}/edit', [DashboardController::class,'blog_store'])->name('blog.store');

    Route::get('/home', [DashboardController::class,'index']);
});
