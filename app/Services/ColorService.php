<?php

namespace App\Services;

use App\Repositories\ColorRepository;

class ColorService extends BaseService
{
	/**
	 * __construct
	 *
	 * @param ColorRepository $colorRepository
	 * @return void
	 */
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

		if (!$colors) {
			return $this->errService();
		}
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

		if (!($color instanceof \App\Models\Color)) {
			return $this->errValidate('The element isn\'t a color model!');
		}
		return $this->successData($color);
	}

	/**
	 * Create a color
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return ResultService
	 */
	public function create($data)
	{
		$color = $this->colorRepository->create($data->toArray());

		if (!($color instanceof \App\Models\Color)) {
			return $this->errValidate('The element isn\'t a color model!');
		}

		if (!$color) {
			return $this->errService();
		}
		return $this->successMessage('Color has been created!');
	}

	/**
	 * Update a color by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update($data, int $id)
	{
		$color = $this->getById($id);

		if (!$color->isSuccess()) {
			return $color;
		}

		$isUpdated = $this->colorRepository->update($data->toArray(), $color->data);

		if (!$isUpdated) {
			return $this->errService();
		}
		return $this->successMessage('Color has been updated!');
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

		return $this->successMessage('Color has been deleted!');
	}
}
