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
		'options.color'
	];

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
		private ImageService $imageService,
	) {
	}

	/**
	 * Get all cars
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$cars = CarFilterService::handle($this->carRepository->all(self::TOLOAD));

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

	/**
	 * Get the users which own to the user
	 *
	 * @param  \App\Models\User $user
	 * @return ResultService
	 */
	public function getUsersCars($user)
	{
		if (is_null($user)) {
			return $this->errNotFound('User hasn\'t been found!');
		}
		if (!($user instanceof \App\Models\User)) {
			return $this->errValidate('The element isn\'t a user model!');
		}

		if ($cars = $this->carRepository->getUsersCars($user)) {
			return $this->successData($cars);
		}
		return $this->errService();
	}
}
