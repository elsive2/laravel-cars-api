<?php

namespace App\Services;

use App\Repositories\BrandRepository;

class BrandService extends BaseService
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
	 * Get all brands
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$brands = $this->brandRepository->all();

		if (!$brands) {
			return $this->errService();
		}
		return $this->successData($brands);
	}

	/**
	 * Get a brand by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function getById(int $id)
	{
		$brand = $this->brandRepository->getById($id);

		if (is_null($brand)) {
			return $this->errNotFound();
		}

		if (!($brand instanceof \App\Models\Brand)) {
			return $this->errValidate('The element isn\'t a brand model!');
		}
		return $this->successData($brand);
	}

	/**
	 * Create a brand
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return ResultService
	 */
	public function create($data)
	{
		$brand = $this->brandRepository->create($data->toArray());

		if (!($brand instanceof \App\Models\Brand)) {
			return $this->errValidate('The element isn\'t a brand model!');
		}

		if (!$brand) {
			return $this->errService();
		}
		return $this->successMessage('Brand has been created!');
	}

	/**
	 * Update a brand by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update($data, int $id)
	{
		$brand = $this->getById($id);

		if (!$brand->isSuccess()) {
			return $brand;
		}

		$isUpdated = $this->brandRepository->update($data->toArray(), $brand->data);

		if (!$isUpdated) {
			return $this->errService();
		}
		return $this->successMessage('Brand has been updated!');
	}

	/**
	 * Delete a brand by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$brand = $this->getById($id);

		if (!$brand->isSuccess()) {
			return $brand;
		}

		$this->brandRepository->delete($brand->data);

		return $this->successMessage('Brand has been deleted!');
	}
}
