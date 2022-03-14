<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository
{
	/**
	 * Get all the cars
	 *
	 * @param  array|string $toLoad
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all($toLoad)
	{
		return Car::with($toLoad)->get();
	}

	/**
	 * Get the car by its id
	 *
	 * @param  int $id
	 * @return Car|null
	 */
	public function getById(int $id)
	{
		return Car::find($id);
	}
}
