<?php

namespace App\Services;

use App\Repositories\CarRepository;

class CarService
{
	/**
	 * __construct
	 *
	 * @param  CarRepository $carRepository
	 * @return void
	 */
	public function __construct(
		private CarRepository $carRepository
	) {
	}

	/**
	 * Get all the cars
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		$toLoad = ['brand', 'country'];

		return $this->carRepository->all($toLoad);
	}

	/**
	 * Get the car by its id
	 *
	 * @param  int $id
	 * @return \App\Models\Car
	 */
	public function getById(int $id)
	{
		$car = $this->carRepository->getById($id);

		abort_if(is_null($car), 404);

		return $car;
	}
}
