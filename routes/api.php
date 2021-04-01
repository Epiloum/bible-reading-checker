<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\App\ReadController;
use App\Http\Controllers\Api\App\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// change from auth:api to auth:web for sharing auth
Route::middleware('auth:web')->get('/user', function (Request $request) {
    return $request->user();
});

$routeApi = function () {
    Route::apiResource('reads', ReadController::class)->only(
        [
            'index',
            'show',
            'store',
            'destroy'
        ]
    );

    Route::apiResource('users', UserController::class)->only(
        [
            'show',
            'store'
        ]
    );
};

if(env('APP_ENV') == 'local')
{
    Route::prefix('app')->group($routeApi);
}
else
{
    Route::middleware('auth:web')->prefix('app')->group($routeApi);
}
