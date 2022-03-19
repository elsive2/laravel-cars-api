<?php

namespace App\Services;

use App\Repositories\{
	BodyRepository,
	BrandRepository,
	CountryRepository,
	CarRepository,
	ColorRepository,
	EngineRepository,
	GearBoxRepository,
	OptionRepository
};

class CarService
{
	/**
	 * __construct
	 *
	 * @param CarRepository $carRepository
	 * @param CountryRepository $countryRepository
	 * @param BrandRepository $brandRepository
	 * @param BodyRepository $bodyRepository
	 * @param ColorRepository $colorRepository
	 * @param GearBoxRepository $gearBoxRepository
	 * @param EngineRepository $engineRepository
	 * @param OptionRepository $optionRepository
	 * @return void
	 */
	public function __construct(
		private CarRepository $carRepository,
		private CountryRepository $countryRepository,
		private BrandRepository $brandRepository,
		private BodyRepository $bodyRepository,
		private ColorRepository $colorRepository,
		private GearBoxRepository $gearBoxRepository,
		private EngineRepository $engineRepository,
		private OptionRepository $optionRepository,
	) {
	}

	/**
	 * Get all cars
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

	/**
	 * Creates a new car
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return \App\Models\Car
	 */
	public function create($data)
	{
		$option = $this->optionRepository->create([
			'wheel_position' => $data->wheel_position,
			'drive_unit' => $data->drive_unit,
			'mileage' => $data->mileage,
			'engine_capacity' => $data->engine_capacity,
			'body_id' => $this->bodyRepository->getByName($data->body)->id,
			'engine_id' => $this->engineRepository->getByName($data->engine)->id,
			'gear_box_id' => $this->gearBoxRepository->getByName($data->gear_box)->id,
			'color_id' => $this->colorRepository->getByName($data->color)->id,
		]);

		return $this->carRepository->create([
			'model' => $data->model,
			'type' => $data->type,
			'price' => $data->price,
			'year' => $data->year,
			'is_working' => $data->is_working,
			'country_id' => $this->countryRepository->getByName($data->country)->id,
			'brand_id' => $this->brandRepository->getByName($data->brand)->id,
			'option_id' => $option->id,
		]);
	}
}
