<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\{
	AuthController,
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

	Route::middleware('auth:sanctum')->group(function () {

		Route::get('my_cars', [CarController::class, 'getMyCars']);

		Route::apiResource('cars', CarController::class);

		Route::apiResource('bodies', BodyController::class);
		Route::apiResource('engines', EngineController::class);
		Route::apiResource('gear_boxes', GearBoxController::class);
		Route::apiResource('colors', ColorController::class);
		Route::apiResource('countries', CountryController::class);
		Route::apiResource('brands', BrandController::class);

		Route::apiResource('images', ImageController::class)
			->except('update');

		Route::post('logout', [AuthController::class, 'logout'])->name('logout');
	});

	Route::post('register', [AuthController::class, 'register'])->name('register');
	Route::post('login', [AuthController::class, 'login'])->name('login');
});
