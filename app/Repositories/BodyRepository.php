<?php

namespace App\Repositories;

use App\Models\Body;

class BodyRepository
{
	/**
	 * Creates a new body
	 *
	 * @param  string $body
	 * @return Body
	 */
	public function create(string $body)
	{
		return Body::create(['name' => $body]);
	}
}
