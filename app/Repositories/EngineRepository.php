<?php

namespace App\Repositories;

use App\Models\Engine;

class EngineRepository
{
	public function create(string $engine)
	{
		return Engine::create(['name' => $engine]);
	}
}
