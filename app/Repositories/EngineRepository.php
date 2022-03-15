<?php

namespace App\Repositories;

use App\Models\Engine;

class EngineRepository
{
	/**
	 * Creates a new engine
	 *
	 * @param  string $engine
	 * @return Engine
	 */
	public function create(string $engine)
	{
		return Engine::create(['name' => $engine]);
	}
}
