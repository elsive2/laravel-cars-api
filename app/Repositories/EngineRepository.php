<?php

namespace App\Repositories;

use App\Models\Engine;

class EngineRepository
{
	/**
	 * Get an engine by its id
	 *
	 * @param  string $engine
	 * @return Engine
	 */
	public function getByName(string $engine)
	{
		return Engine::whereName($engine)->first();
	}
}
