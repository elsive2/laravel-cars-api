<?php

namespace App\Services;

use App\Repositories\CarRepository;
use App\Repositories\OptionRepository;

class CarService extends BaseService
{
	/**
	 * __construct
	 *
	 * @param CarRepository $carRepository
	 * @param OptionRepository $optionRepository
	 * @return void
	 */
	public function __construct(
		private CarRepository $carRepository,
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
	 * @param  \App\Helpers\CarObject $data
	 * @return ResultService
	 */
	public function create($data)
	{
		$option = $this->optionRepository->create($data->getOptionsData());

		if (is_null($option)) {
			return $this->errNotFound('Options hasn\'t been found!');
		}
		if (!($option instanceof \App\Models\Option)) {
			return $this->errValidate('The element isn\'t a option model!');
		}

		$carData = $data->getCarData();
		$carData['option_id'] = $option->id;

		if (!$this->carRepository->create($carData)) {
			return $this->errService();
		}
		return $this->successMessage('Success! Your car will be published after moderation!');
	}
}
