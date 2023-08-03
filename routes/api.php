<?php

use App\Http\Controllers\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {


Route::controller(ApiAuthController::class)->group(function () {
    Route::post("register", 'register');
    Route::post("login", 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ApiAuthController::class)->group(function () {
        Route::post("logout", 'logout');
        Route::post("logout-all", 'logoutAll');
        Route::post("devices", 'devices');
    });

    });

});

