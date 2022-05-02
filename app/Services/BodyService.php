<?php

namespace App\Services;

use App\Repositories\BodyRepository;

class BodyService extends BaseService
{
	/**
	 * __construct
	 *
	 * @param BodyRepository $bodyRepository
	 * @return void
	 */
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

		if (!$bodies) {
			return $this->errService();
		}
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

		if (!($body instanceof \App\Models\Body)) {
			return $this->errValidate(__('api.body.not_body_model'));
		}
		return $this->successData($body);
	}

	/**
	 * Create a body
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return ResultService
	 */
	public function create($data)
	{
		$body = $this->bodyRepository->create($data->toArray());

		if (!($body instanceof \App\Models\Body)) {
			return $this->errValidate(__('api.body.not_body_model'));
		}

		if (!$body) {
			return $this->errService();
		}
		return $this->successMessage(__('api.body.created'));
	}

	/**
	 * Update a body by its id
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

		$isUpdated = $this->bodyRepository->update($data->toArray(), $brand->data);

		if (!$isUpdated) {
			return $this->errService();
		}
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
