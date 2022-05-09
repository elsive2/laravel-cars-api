<?php

namespace App\Services;

use App\Repositories\ColorRepository;

class ColorService extends BaseService
{
	public function __construct(
		private ColorRepository $colorRepository
	) {
	}

	/**
	 * Get all colors
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$colors = $this->colorRepository->all();
		return $this->successData($colors);
	}

	/**
	 * Get a color by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function getById(int $id)
	{
		$color = $this->colorRepository->getById($id);

		if (is_null($color)) {
			return $this->errNotFound();
		}
		return $this->successData($color);
	}

	/**
	 * Create a color
	 *
	 * @param  array $data
	 * @return ResultService
	 */
	public function create(array $data)
	{
		$this->colorRepository->create($data);
		return $this->successMessage(__('api.color.created'));
	}

	/**
	 * Update a color by its id
	 *
	 * @param  array $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update(array $data, int $id)
	{
		$color = $this->getById($id);

		if (!$color->isSuccess()) {
			return $color;
		}
		$this->colorRepository->update($data, $color->data);
		return $this->successMessage(__('api.color.updated'));
	}

	/**
	 * Delete a color by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$color = $this->getById($id);

		if (!$color->isSuccess()) {
			return $color;
		}
		$this->colorRepository->delete($color->data);
		return $this->successMessage(__('api.color.deleted'));
	}
}
