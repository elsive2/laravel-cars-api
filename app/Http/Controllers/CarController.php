<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Http\Resources\CarResource;
use App\Services\CarService;
use Illuminate\Http\Request;

class CarController extends Controller
{
	/**
	 * __construct
	 *
	 * @param  CarService $carService
	 * @return void
	 */
	public function __construct(
		private CarService $carService
	) {
	}

	/**
	 * Display a listing of the cars.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{
		return CarResource::collection($this->carService->all());
	}

	/**
	 * Display the specified car.
	 *
	 * @param  int  $id
	 * @return CarResource
	 */
	public function show(int $id)
	{
		return new CarResource($this->carService->getById($id));
	}

	/**
	 * Store a newly created car in storage.
	 *
	 * @param  CarStoreRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CarStoreRequest $request)
	{
		$this->carService->create($request->safe());

		return response()->json([
			'data' => 'Car has been created!'
		]);
	}

	/**
	 * Update the specified car in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified car from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
