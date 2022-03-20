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
	 * @return ResultService
	 */
	public function all()
	{
		$toLoad = [
			'brand',
			'country',
			'images',
			'options',
			'options.body',
			'options.gearBox',
			'options.engine',
			'options.color'
		];

		$cars = $this->carRepository->all($toLoad);

		if (!$cars) {
			return $this->errService();
		}
		return $this->successData($cars);
	}

	/**
	 * Get the car by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function getById(int $id)
	{
		$car = $this->carRepository->getById($id);

		if (is_null($car)) {
			return $this->errNotFound('Car hasn\'t been found!');
		}
		if (!($car instanceof \App\Models\Car)) {
			return $this->errValidate('The element isn\'t a car model');
		}
		return $this->successData($car);
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

	/**
	 * Update a car by its id
	 *
	 * @param  \App\Helpers\CarObject $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update($data, int $id)
	{
		$car = $this->getById($id);

		if (!$car->isSuccess()) {
			return $car;
		}

		if ($data->optionDataHas()) {
			if (!$this->optionRepository->updateCarOptions($car->data, $data->getOptionsData())) {
				return $this->errService();
			}
		}
		if ($data->carDataHas()) {
			if (!$this->carRepository->update($car->data, $data->getCarData())) {
				return $this->errService();
			}
		}
		return $this->successMessage('Car has been updated!');
	}

	/**
	 * Delete a car by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$car = $this->getById($id);

		if (!$car->isSuccess()) {
			return $car;
		}

		$this->carRepository->delete($car->data);

		return $this->successMessage('Car has been deleted!');
	}
}
