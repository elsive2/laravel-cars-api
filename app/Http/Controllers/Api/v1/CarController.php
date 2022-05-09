<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\CarObject;
use App\Http\Requests\CarFilterRequest;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Http\Resources\v1\CarResource;
use App\Services\CarService;

class CarController extends Controller
{
	public function __construct(private CarService $carService)
	{
		$this->resource = CarResource::class;
	}

	/**
	 * Display a listing of the cars.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(CarFilterRequest $request)
	{
		$result = $this->carService->all($request->validated());
		return $this->resultCollection($result);
	}

	/**
	 * Display the specified car.
	 *
	 * @param  int  $id
	 * @return CarResource
	 */
	public function show(int $id)
	{
		$result = $this->carService->getById($id);
		return $this->resultResource($result);
	}

	/**
	 * Store a newly created car in storage.
	 *
	 * @param  CarStoreRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CarStoreRequest $request)
	{
		$result = $this->carService->create(new CarObject($request->safe()));
		return $this->result($result);
	}

	/**
	 * Update the specified car in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(CarUpdateRequest $request, int $id)
	{
		$result = $this->carService->update(new CarObject($request->safe()), $id);
		return $this->result($result);
	}

	/**
	 * Remove the specified car from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(int $id)
	{
		$result = $this->carService->delete($id);
		return $this->result($result);
	}

	/**
	 * Get all the user's cars
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function getUsersCars()
	{
		$result = $this->carService->getUsersCars(auth()->user());
		return $this->resultCollection($result, CarResource::class);
	}
}
