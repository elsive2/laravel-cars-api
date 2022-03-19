<?php

namespace App\Repositories;

use App\Models\Engine;

class EngineRepository
{
	/**
	 * Get all engines
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return Engine::all();
	}

	/**
	 * Get an engine by its id
	 *
	 * @param  int $id
	 * @return Engine|null
	 */
	public function getById(int $id)
	{
		return Engine::find($id);
	}

	/**
	 * Create a new Engine
	 *
	 * @param  array $data
	 * @return Engine
	 */
	public function create(array $data)
	{
		return Engine::create($data);
	}

	/**
	 * Update the engine
	 *
	 * @param  array $data
	 * @param  Engine $Engine
	 * @return bool
	 */
	public function update(array $data, Engine $engine)
	{
		return $engine->update($data);
	}

	/**
	 * Delete the engine
	 *
	 * @param  Engine $engine
	 * @return bool|null
	 */
	public function delete(Engine $engine)
	{
		return $engine->delete();
	}
}
