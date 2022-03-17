<?php

namespace App\Services;

use App\Repositories\GearBoxRepository;

class GearBoxService
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
	 * Get all the gear boxes
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return $this->gearBoxRepository->all();
	}

	/**
	 * Get a gear box by its id
	 *
	 * @param  int $id
	 * @return \App\Models\GearBox
	 */
	public function getById(int $id)
	{
		$gearBox = $this->gearBoxRepository->getById($id);

		abort_if(is_null($gearBox), 404);

		return $gearBox;
	}

	/**
	 * Create a gear box
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return \App\Models\GearBox
	 */
	public function create($data)
	{
		return $this->gearBoxRepository->create($data->toArray());
	}

	/**
	 * Update a gear box by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return bool
	 */
	public function update($data, int $id)
	{
		$gearBox = $this->getById($id);

		return $this->gearBoxRepository->update($data->toArray(), $gearBox);
	}

	/**
	 * Delete a gear box by its id
	 *
	 * @param  int $id
	 * @return bool|null
	 */
	public function delete(int $id)
	{
		$gearBox = $this->getById($id);

		return $this->gearBoxRepository->delete($gearBox);
	}
}
