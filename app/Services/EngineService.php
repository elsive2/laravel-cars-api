<?php

namespace App\Services;

use App\Repositories\EngineRepository;

class EngineService
{
	/**
	 * __construct
	 *
	 * @param EngineRepository $engineRepository
	 * @return void
	 */
	public function __construct(
		private EngineRepository $engineRepository
	) {
	}

	/**
	 * Get all the engines
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return $this->engineRepository->all();
	}

	/**
	 * Get an engine by its id
	 *
	 * @param  int $id
	 * @return \App\Models\Engine
	 */
	public function getById(int $id)
	{
		$engine = $this->engineRepository->getById($id);

		abort_if(is_null($engine), 404);

		return $engine;
	}

	/**
	 * Create an engine
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return \App\Models\Engine
	 */
	public function create($data)
	{
		return $this->engineRepository->create($data->toArray());
	}

	/**
	 * Update an engine by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return bool
	 */
	public function update($data, int $id)
	{
		$engine = $this->getById($id);

		return $this->engineRepository->update($data->toArray(), $engine);
	}

	/**
	 * Delete an engine by its id
	 *
	 * @param  int $id
	 * @return bool|null
	 */
	public function delete(int $id)
	{
		$engine = $this->getById($id);

		return $this->engineRepository->delete($engine);
	}
}
