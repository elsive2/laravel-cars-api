<?php

namespace App\Services;

use App\Repositories\EngineRepository;

class EngineService extends BaseService
{
	/**
	 * __construct
	 *
	 * @param EngineRepository $engineRepository
	 * @return ResultService
	 */
	public function __construct(
		private EngineRepository $engineRepository
	) {
	}

	/**
	 * Get all the engines
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$engines = $this->engineRepository->all();

		if (!$engines) {
			return $this->errService();
		}
		return $this->successData($engines);
	}

	/**
	 * Get an engine by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function getById(int $id)
	{
		$engine = $this->engineRepository->getById($id);

		if (is_null($engine)) {
			return $this->errNotFound();
		}

		if (!($engine instanceof \App\Models\Engine)) {
			return $this->errValidate('The element isn\'t a engine model!');
		}
		return $this->successData($engine);
	}

	/**
	 * Create an engine
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return ResultService
	 */
	public function create($data)
	{
		$engine = $this->engineRepository->create($data->toArray());

		if (!($engine instanceof \App\Models\Engine)) {
			return $this->errValidate('The element isn\'t a engine model!');
		}

		if (!$engine) {
			return $this->errService();
		}
		return $this->successMessage('Engine has been created!');
	}

	/**
	 * Update an engine by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update($data, int $id)
	{
		$isUpdated = $this->engineRepository->update($data->toArray(), $this->getById($id)->data);

		if (!$isUpdated) {
			return $this->errService();
		}
		return $this->successMessage('Engine has been updated!');
	}

	/**
	 * Delete an engine by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$this->engineRepository->delete($this->getById($id)->data);

		return $this->successMessage('Engine has been deleted!');
	}
}
