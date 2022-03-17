<?php

namespace App\Services;

use App\Repositories\ColorRepository;

class ColorService
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
	 * Get all the colors
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return $this->colorRepository->all();
	}

	/**
	 * Get a color by its id
	 *
	 * @param  int $id
	 * @return \App\Models\Color
	 */
	public function getById(int $id)
	{
		$color = $this->colorRepository->getById($id);

		abort_if(is_null($color), 404);

		return $color;
	}

	/**
	 * Create a color
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return \App\Models\Color
	 */
	public function create($data)
	{
		return $this->colorRepository->create($data->toArray());
	}

	/**
	 * Update a color by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return bool
	 */
	public function update($data, int $id)
	{
		$color = $this->getById($id);

		return $this->colorRepository->update($data->toArray(), $color);
	}

	/**
	 * Delete a color by its id
	 *
	 * @param  int $id
	 * @return bool|null
	 */
	public function delete(int $id)
	{
		$color = $this->getById($id);

		return $this->colorRepository->delete($color);
	}
}
