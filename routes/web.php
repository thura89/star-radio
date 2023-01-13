<?php

use App\Http\Controllers\Frontend\CommonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\ProgramController;
use App\Http\Controllers\LocalizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home/locale/{lange}', [LocalizationController::class,'homesetlang']);

Route::get('/', [HomePageController::class, 'index'])->name('home.index');
Route::get('/programs', [ProgramController::class, 'index'])->name('home.programs');
Route::get('/category/{category}/programs', [ProgramController::class, 'programs'])->name('home.category_programs');
Route::get('/programs/{id}/show', [ProgramController::class, 'show'])->name('home.programs.show');
Route::get('/news/{id}/all', [CommonController::class, 'news'])->name('home.news.all');
Route::get('/news/{id}/show', [CommonController::class, 'show'])->name('home.news.show');
Route::get('/all_news', [CommonController::class, 'all_news'])->name('home.all_news');
Route::get('/news', [HomePageController::class, 'news'])->name('home.news');
Route::get('/other_news', [HomePageController::class, 'news'])->name('home.other_news');

// Events
Route::get('/events', [CommonController::class, 'events'])->name('home.events');
Route::get('/events/{id}/show', [CommonController::class, 'event_show'])->name('home.event.show');

Route::get('/nobles', [CommonController::class, 'nobles'])->name('home.nobles');
Route::get('/nobles/{cate}', [CommonController::class, 'noblesbycate'])->name('home.nobles.cate');
Route::get('/nobles/{id}/show', [CommonController::class, 'nobles_show'])->name('home.noble.show');

// Song Request
Route::post('/song_request', [CommonController::class, 'storeSongRequest'])->name('home.songRequest.store');
Route::get('/song_request', [CommonController::class, 'songRequest'])->name('home.songRequest');

// About
Route::get('/about', [CommonController::class, 'about'])->name('home.about');

// Contact
Route::get('/contact', [CommonController::class, 'contact'])->name('home.contact');

// About Us
Route::get('/about', [CommonController::class,'blogs'])->name('home.about');

// Contact Us
Route::get('/contact', [CommonController::class,'blogs'])->name('home.contact');

// Daily Schedule
Route::get('/daily_schedule', [CommonController::class,'blogs'])->name('home.daily_schedule');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
