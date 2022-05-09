<?php

namespace App\Services;

use App\Repositories\CarRepository;
use App\Repositories\OptionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarService extends BaseService
{
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
		$cars = CarFilterService::handle($this->carRepository->all(), $data);
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
		try {
			DB::beginTransaction();

			$option = $this->optionRepository->create($data->getOptionsData());

			$carData = $data->getCarData();
			$carData['option_id'] = $option->id;
			$carData['user_id'] = auth()->user()->id;

			$car = $this->carRepository->create($carData);

			if (isset($data->data->images_id)) {
				$savedResult = $this->imageService->addImagesToModel($car, $data->data->images_id);

				if (!$savedResult->isSuccess()) {
					return $savedResult;
				}
			}

			DB::commit();
		} catch (\Exception $e) {
			Log::error(__METHOD__ . ' ' . $e->getMessage());
			DB::rollBack();
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

			$deletedResult = $this->imageService->deleteAllFrom($car->data);
			if (!$deletedResult->isSuccess()) {
				return $deletedResult;
			}

			$savedResult = $this->imageService->addImagesToModel($car->data, $data->data->images_id);
			if (!$savedResult->isSuccess()) {
				return $savedResult;
			}
		}

		if ($data->optionDataHas()) {
			$this->optionRepository->updateCarOptions($car->data, $data->getOptionsData());
		}
		if ($data->carDataHas()) {
			$this->carRepository->update($car->data, $data->getCarData());
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
		return $this->successData($this->carRepository->getUsersCars($user));
	}
}
