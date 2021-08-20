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

// Index
Route::get('/', [GeneralController::class, 'index'])->name('index');

// Social Login
Route::get('social/req', [GeneralController::class, 'reqLogin'])->name('social.request');

Route::get('social/{provider}', [
    'as' => 'social.login',
    'uses' => 'App\Http\Controllers\Auth\SocialController@execute',
]);

Route::redirect('home', 'app/reading');

// App
$routeApp = function () {
    // Entrance
    Route::redirect('/', 'app/reading');

    // Bible Reading Table
    Route::get('reading', [ReadingController::class, 'index']);
    Route::get('tickets', [TicketController::class, 'index']);
};

if(env('APP_ENV') == 'local')
{
    Route::prefix('app')->group($routeApp);
}
else
{
    Route::middleware('auth')->prefix('app')->group($routeApp);
}

// Reserve
Route::get('/reserve', function () {
    return view('reserve');
});
