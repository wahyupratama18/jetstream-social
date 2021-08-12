<?php

use App\Http\Controllers\Auth\{
    FacebookController,
    GithubController,
    GoogleController,
    LinkedinController,
    TwitterController
};
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
Route::prefix('auth')->name('social.')->group(function () {
    Route::prefix('google')->name('google.')->group(function () {
        Route::get('/', [GoogleController::class, 'redirect'])->name('redirection');
        Route::get('/callback', [GoogleController::class, 'callback'])->name('callback');
    });
    
    Route::prefix('github')->name('github.')->group(function () {
        Route::get('/', [GithubController::class, 'redirect'])->name('redirection');
        Route::get('/callback', [GithubController::class, 'callback'])->name('callback');
    });

    Route::prefix('twitter')->name('twitter.')->group(function () {
        Route::get('/', [TwitterController::class, 'redirect'])->name('redirection');
        Route::get('/callback', [TwitterController::class, 'callback'])->name('callback');
    });

    Route::prefix('linkedin')->name('linkedin.')->group(function () {
        Route::get('/', [LinkedinController::class, 'redirect'])->name('redirection');
        Route::get('/callback', [LinkedinController::class, 'callback'])->name('callback');
    });

    Route::prefix('facebook')->name('facebook.')->group(function () {
        Route::get('/', [FacebookController::class, 'redirect'])->name('redirection');
        Route::get('/callback', [FacebookController::class, 'callback'])->name('callback');
    });
});

Route::middleware(['auth:sanctum', 'verified'])
->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
