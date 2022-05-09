<?php

namespace App\Services;

use App\Repositories\BodyRepository;

class BodyService extends BaseService
{
	public function __construct(
		private BodyRepository $bodyRepository
	) {
	}

	/**
	 * Get all bodies
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$bodies = $this->bodyRepository->all();
		return $this->successData($bodies);
	}

	/**
	 * Get a body by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function getById(int $id)
	{
		$body = $this->bodyRepository->getById($id);

		if (is_null($body)) {
			return $this->errNotFound();
		}
		return $this->successData($body);
	}

	/**
	 * Create a body
	 *
	 * @param  array $data
	 * @return ResultService
	 */
	public function create(array $data)
	{
		$this->bodyRepository->create($data);
		return $this->successMessage(__('api.body.created'));
	}

	/**
	 * Update a body by its id
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
		$this->bodyRepository->update($data, $brand->data);
		return $this->successMessage(__('api.body.updated'));
	}

	/**
	 * Delete a body by its id
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
		$this->bodyRepository->delete($brand->data);
		return $this->successMessage(__('api.body.deleted'));
	}
}
