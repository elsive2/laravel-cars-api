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
	ImageController,
	LanguageController
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


Route::middleware('auth:sanctum')->group(function () {

	// available only for admins
	Route::middleware('abilities:admin')->group(function () {
		Route::apiResource('bodies', BodyController::class)
			->only('store', 'update', 'delete');
		Route::apiResource('engines', EngineController::class)
			->only('store', 'update', 'delete');
		Route::apiResource('gear_boxes', GearBoxController::class)
			->only('store', 'update', 'delete');
		Route::apiResource('colors', ColorController::class)
			->only('store', 'update', 'delete');
		Route::apiResource('countries', CountryController::class)
			->only('store', 'update', 'delete');
		Route::apiResource('brands', BrandController::class)
			->only('store', 'update', 'delete');
	});

	Route::get('my_cars', [CarController::class, 'getUsersCars']);

	Route::apiResource('cars', CarController::class)
		->only('store', 'update', 'destroy');

	Route::apiResource('images', ImageController::class)
		->except('update');

	Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::apiResource('bodies', BodyController::class)
	->only('index', 'show');
Route::apiResource('engines', EngineController::class)
	->only('index', 'show');
Route::apiResource('gear_boxes', GearBoxController::class)
	->only('index', 'show');
Route::apiResource('colors', ColorController::class)
	->only('index', 'show');
Route::apiResource('countries', CountryController::class)
	->only('index', 'show');
Route::apiResource('brands', BrandController::class)
	->only('index', 'show');

Route::apiResource('cars', CarController::class)
	->only('index', 'show');

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('lang/{lang}', LanguageController::class)->name('lang.switch');
