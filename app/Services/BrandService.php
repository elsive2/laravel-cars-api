<?php

namespace App\Services;

use App\Repositories\BrandRepository;

class BrandService extends BaseService
{
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
		return $this->successData($brand);
	}

	/**
	 * Create a brand
	 *
	 * @param  array $data
	 * @return ResultService
	 */
	public function create(array $data)
	{
		$brand = $this->brandRepository->create($data);

		if (!$brand) {
			return $this->errService();
		}
		return $this->successMessage(__('api.brand.created'));
	}

	/**
	 * Update a brand by its id
	 *
	 * @param  array $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update(array $data, int $id)
	{
		$brand = $this->getById($id);

		if (!$brand->isSuccess()) {
			return $brand;
		}
		$this->brandRepository->update($data, $brand->data);
		return $this->successMessage(__('api.brand.updated'));
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
		return $this->successMessage(__('api.brand.deleted'));
	}
}
