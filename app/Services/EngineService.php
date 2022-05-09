<?php

namespace App\Services;

use App\Repositories\EngineRepository;

class EngineService extends BaseService
{
	public function __construct(
		private EngineRepository $engineRepository
	) {
	}

	/**
	 * Get all engines
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$engines = $this->engineRepository->all();

		if ($engines->empty()) {
			return $this->successMessage(__('api.engine.no'));
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
		return $this->successData($engine);
	}

	/**
	 * Create an engine
	 *
	 * @param  array $data
	 * @return ResultService
	 */
	public function create(array $data)
	{
		$this->engineRepository->create($data);
		return $this->successMessage(__('api.engine.created'));
	}

	/**
	 * Update an engine by its id
	 *
	 * @param  array $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update(array $data, int $id)
	{
		$engine = $this->getById($id);

		if (!$engine->isSuccess()) {
			return $engine;
		}
		$this->engineRepository->update($data, $engine->data);
		return $this->successMessage(__('api.engine.updated'));
	}

	/**
	 * Delete an engine by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$engine = $this->getById($id);

		if (!$engine->isSuccess()) {
			return $engine;
		}
		$this->engineRepository->delete($engine->data);
		return $this->successMessage(__('api.engine.deleted'));
	}
}
