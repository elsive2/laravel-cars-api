<?php

namespace App\Repositories;

use App\Models\Body;

class BodyRepository
{
	/**
	 * Get a body by its body
	 *
	 * @param  string $body
	 * @return Body
	 */
	public function getByName(string $body)
	{
		return Body::whereName($body)->first();
	}
}
