<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository
{
	/**
	 * Get all cars
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function all()
	{
		return Car::with([
			'brand',
			'country',
			'images',
			'options',
			'options.body',
			'options.gearBox',
			'options.engine',
			'options.color',
			'user'
		])->where('is_active', 1);
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

	/**
	 * Create a new car
	 *
	 * @param  array $data
	 * @return Car
	 */
	public function create(array $data)
	{
		return Car::create($data);
	}

	/**
	 * Update the car
	 *
	 * @param  Car $car
	 * @param  array $data
	 * @return bool
	 */
	public function update(Car $car, array $data)
	{
		return $car->update($data);
	}

	/**
	 * Delete the car
	 *
	 * @param  Car $car
	 * @return bool|null
	 */
	public function delete(Car $car)
	{
		return $car->delete();
	}

	/**
	 * Get the users which own to the user
	 * 
	 * @param  \App\Models\User $user
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getUsersCars($user)
	{
		return $user->cars;
	}
}
