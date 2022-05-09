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
		return $this->successData($gearBox);
	}

	/**
	 * Create a gear box
	 *
	 * @param  array $data
	 * @return ResultService
	 */
	public function create(array $data)
	{
		$this->gearBoxRepository->create($data);
		return $this->successMessage(__('api.gear_box.created'));
	}

	/**
	 * Update a gear box by its id
	 *
	 * @param  array $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update(array $data, int $id)
	{
		$gearBox = $this->getById($id);

		if (!$gearBox->isSuccess()) {
			return $gearBox;
		}
		$this->gearBoxRepository->update($data, $gearBox->data);
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
