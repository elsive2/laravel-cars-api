<?php

namespace App\Services;

use App\Repositories\BrandRepository;

class BrandService
{
	/**
	 * __construct
	 *
	 * @param BrandRepository $brandRepository
	 * @return void
	 */
	public function __construct(
		private BrandRepository $brandRepository
	) {
	}

	/**
	 * Get all the brands
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return $this->brandRepository->all();
	}

	/**
	 * Get a brand by its id
	 *
	 * @param  int $id
	 * @return \App\Models\Brand
	 */
	public function getById(int $id)
	{
		$brand = $this->brandRepository->getById($id);

		abort_if(is_null($brand), 404);

		return $brand;
	}

	/**
	 * Create a brand
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return \App\Models\Brand
	 */
	public function create($data)
	{
		return $this->brandRepository->create($data->toArray());
	}

	/**
	 * Update a brand by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return bool
	 */
	public function update($data, int $id)
	{
		$brand = $this->getById($id);

		return $this->brandRepository->update($data->toArray(), $brand);
	}

	/**
	 * Delete a brand by its id
	 *
	 * @param  int $id
	 * @return bool|null
	 */
	public function delete(int $id)
	{
		$brand = $this->getById($id);

		return $this->brandRepository->delete($brand);
	}
}
