<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
	BodyController,
	CarController,
	EngineController
};

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

Route::apiResource('bodies', BodyController::class);

Route::apiResource('engines', EngineController::class);

Route::apiResource('cars', CarController::class);
