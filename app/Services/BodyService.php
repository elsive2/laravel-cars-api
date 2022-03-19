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
	 * Get all the bodies
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
			return $this->errValidate('The element isn\'t a body model!');
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
			return $this->errValidate('The element isn\'t a body model!');
		}

		if (!$body) {
			return $this->errService();
		}
		return $this->successMessage('Body has been created!');
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
		$isUpdated = $this->bodyRepository->update($data->toArray(), $this->getById($id)->data);

		if (!$isUpdated) {
			return $this->errService();
		}
		return $this->successMessage('Body has been updated!');
	}

	/**
	 * Delete a body by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$this->bodyRepository->delete($this->getById($id)->data);

		return $this->successMessage('Body has been deleted!');
	}
}
