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

Route::get('/', function () {
    return view('welcome');
});

// Social Auths
Route::prefix('auth/{driver}')
->name('social.')->group(function () {
    
    Route::get('/', [SocialiteController::class, 'redirect'])->name('redirection')->where('driver', implode('|', config('services.socials')));
    Route::get('/callback', [SocialiteController::class, 'callback'])->name('callback')->where('driver', implode('|', config('services.socials')));
    
});

Route::middleware(['auth:sanctum', 'verified'])
->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
