<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\RateHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\UserSubscriptionController;
use App\Http\Controllers\ApiUsageController;
use App\Http\Controllers\LogController;
 

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
 

// Routes requiring authentication
Route::middleware('auth:api')->group(function () {

    Route::apiResource('banks', BankController::class);
    Route::apiResource('currencies', CurrencyController::class);
    Route::apiResource('exchange-rates', ExchangeRateController::class);
    Route::apiResource('rate-history', RateHistoryController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('subscription-plans', SubscriptionPlanController::class);
    Route::apiResource('user-subscriptions', UserSubscriptionController::class);
    Route::apiResource('api-usage', ApiUsageController::class);
    Route::apiResource('logs', LogController::class);
    
});

