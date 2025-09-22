<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GaraponController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "api"
| middleware group. Enjoy building your API!
|
*/

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::group(['middleware' => 'api_auth', 'prefix' => 'checkin'], function () {
    Route::post('garapon/spin', [GaraponController::class, 'spin']);
});
