<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\TicketController;

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

/*
|--------------------------------------------------------------------------
| Index
|--------------------------------------------------------------------------
*/
Route::get('/', [GeneralController::class, 'index'])->name('index');
Route::redirect('home', 'app/reading');


/*
|--------------------------------------------------------------------------
| Social Login
|--------------------------------------------------------------------------
*/
Route::prefix('social')->group(function(){
    Route::get('req', [GeneralController::class, 'reqLogin'])->name('social.request');
    Route::get('{provider}', [
        'as' => 'social.login',
        'uses' => 'App\Http\Controllers\Auth\SocialController@execute',
    ]);
});


/*
|--------------------------------------------------------------------------
| App
|--------------------------------------------------------------------------
*/
$routeApp = (env('APP_ENV') == 'local')?
    Route::prefix('app'):
    Route::middleware('auth')->prefix('app');

$routeApp->group(function () {
    // Entrance
    Route::redirect('/', 'app/reading');

    // Bible Reading Table
    Route::get('reading', [ReadingController::class, 'index']);
    Route::get('tickets', [TicketController::class, 'index']);
});


/*
|--------------------------------------------------------------------------
| Etc
|--------------------------------------------------------------------------
*/
Route::get('/reserve', function () { return view('reserve'); });
Route::get('/who-is-jesus', function () { return view('landing');});
Route::get('/one-day-worship', function () { return view('oneDayWorship'); });
