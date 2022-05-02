<?php

namespace App\Services;

use App\Repositories\GearBoxRepository;

class GearBoxService extends BaseService
{
	/**
	 * __construct
	 *
	 * @param GearBoxRepository $gearBoxRepository
	 * @return void
	 */
	public function __construct(
		private GearBoxRepository $gearBoxRepository
	) {
	}

	/**
	 * Get all gear boxes
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$gearBoxes = $this->gearBoxRepository->all();

		if (!$gearBoxes) {
			return $this->errService();
		}
		return $this->successData($gearBoxes);
	}

	/**
	 * Get a gear box by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function getById(int $id)
	{
		$gearBox = $this->gearBoxRepository->getById($id);

		if (is_null($gearBox)) {
			return $this->errNotFound();
		}

		if (!($gearBox instanceof \App\Models\GearBox)) {
			return $this->errValidate(__('api.gear_box.not_gear_box_model'));
		}
		return $this->successData($gearBox);
	}

	/**
	 * Create a gear box
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return ResultService
	 */
	public function create($data)
	{
		$gearBox = $this->gearBoxRepository->create($data->toArray());

		if (!($gearBox instanceof \App\Models\GearBox)) {
			return $this->errValidate(__('api.gear_box.not_gear_box_model'));
		}

		if (!$gearBox) {
			return $this->errService();
		}
		return $this->successMessage(__('api.gear_box.created'));
	}

	/**
	 * Update a gear box by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update($data, int $id)
	{
		$gearBox = $this->getById($id);

		if (!$gearBox->isSuccess()) {
			return $gearBox;
		}

		$isUpdated = $this->gearBoxRepository->update($data->toArray(), $gearBox->data);

		if (!$isUpdated) {
			return $this->errService();
		}
		return $this->successMessage(__('api.gear_box.updated'));
	}

	/**
	 * Delete a gear box by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$gearBox = $this->getById($id);

		if (!$gearBox->isSuccess()) {
			return $gearBox;
		}

		$this->gearBoxRepository->delete($gearBox->data);

		return $this->successMessage(__('api.gear_box.deleted'));
	}
}
