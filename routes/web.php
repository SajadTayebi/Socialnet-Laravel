<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('guest')->name('home');
Route::get('/post', [App\Http\Controllers\HomeController::class, 'post'])->middleware('auth')->name('post');

Route::post('/submit_feed', [\App\Http\Controllers\FeedController::class, 'new_feed'])->name('new_feed');
Route::post('/submit_like/{feed}', [\App\Http\Controllers\FeedController::class, 'submit_like'])->name('submit_like');

Route::get('/profile/{user}', [\App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
Route::post('/follow/{user}', [\App\Http\Controllers\ProfileController::class, 'click_follow'])->name('click_follow');
