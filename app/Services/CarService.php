<?php

namespace App\Services;

use App\Repositories\CarRepository;
use App\Repositories\OptionRepository;

class CarService extends BaseService
{
	const TOLOAD = [
		'brand',
		'country',
		'images',
		'options',
		'options.body',
		'options.gearBox',
		'options.engine',
		'options.color',
		'user',
	];

	public function __construct(
		private CarRepository $carRepository,
		private OptionRepository $optionRepository,
		private ImageService $imageService,
	) {
	}

	/**
	 * Get all cars
	 *
	 * @param array $data
	 * @return ResultService
	 */
	public function all(array $data)
	{
		$cars = CarFilterService::handle($this->carRepository->all(self::TOLOAD), $data);
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
			return $this->errNotFound(__('api.car.not_found'));
		}
		if (!($car instanceof \App\Models\Car)) {
			return $this->errValidate(__('api.car.not_car_model'));
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
			return $this->errNotFound(__('api.options.not_found'));
		}
		if (!($option instanceof \App\Models\Option)) {
			return $this->errValidate(__('api.options.not_option_model'));
		}

		$carData = $data->getCarData();
		$carData['option_id'] = $option->id;
		$carData['user_id'] = auth()->user()->id;

		$car = $this->carRepository->create($carData);

		// interacting with images
		if (isset($data->data->images_id)) {
			$images = $data->data->images_id;
			$savingResult = $this->imageService->addImagesToModel($car, $images);

			if (!$savingResult->isSuccess()) {
				return $savingResult;
			}
		}
		if (!$car) {
			return $this->errService();
		}
		return $this->successMessage(__('api.car.success'));
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
		if (auth()->user()->id != $car->data->user_id && !auth()->user()->is_admin) {
			return $this->errForbidden(__('api.car.strange'));
		}
		if (isset($data->data->images_id)) {
			$images = $data->data->images_id;
			$deletedResult = $this->imageService->deleteAllFrom($car->data);

			if (!$deletedResult->isSuccess()) {
				return $deletedResult;
			}

			$savedResult = $this->imageService->addImagesToModel($car->data, $images);
			if (!$savedResult->isSuccess()) {
				return $savedResult;
			}
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
		return $this->successMessage(__('api.car.updated'));
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
		if (auth()->user()->id != $car->data->user_id && !auth()->user()->is_admin) {
			return $this->errForbidden(__('api.car.strange'));
		}
		$this->carRepository->delete($car->data);
		return $this->successMessage(__('api.car.deleted'));
	}

	/**
	 * Get the users which own to the user
	 *
	 * @param  \App\Models\User $user
	 * @return ResultService
	 */
	public function getUsersCars($user)
	{
		if (is_null($user)) {
			return $this->errNotFound(__('api.auth.user_not_found'));
		}
		if (!($user instanceof \App\Models\User)) {
			return $this->errValidate(__('api.auth.not_user_model'));
		}
		if ($cars = $this->carRepository->getUsersCars($user)) {
			return $this->successData($cars);
		}
		return $this->errService();
	}
}
