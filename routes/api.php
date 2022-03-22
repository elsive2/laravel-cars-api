<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\{
	BodyController,
	BrandController,
	CarController,
	ColorController,
	CountryController,
	EngineController,
	GearBoxController,
	ImageController
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

Route::prefix('v1')->name('v1.')->group(function () {
	Route::apiResource('bodies', BodyController::class);
	Route::apiResource('engines', EngineController::class);
	Route::apiResource('gear_boxes', GearBoxController::class);
	Route::apiResource('colors', ColorController::class);
	Route::apiResource('countries', CountryController::class);
	Route::apiResource('brands', BrandController::class);

	Route::apiResource('images', ImageController::class)
		->except('update');

	Route::apiResource('cars', CarController::class);
});
