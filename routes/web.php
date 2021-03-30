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

// Index
Route::get('/', function () {
    return view('index');
});

// Social Login
Route::get('/social/{provider}', [
    'as' => 'social.login',
    'uses' => 'App\Http\Controllers\Auth\SocialController@execute',
]);

// App
Route::prefix('app')->middleware('auth')->group(function () {
    // Entrance
    Route::redirect('/', 'reading')->name('auth.welcome');

    // Bible Reading Table
    Route::get('reading', function () {
        return 'TEST';
    });
});
