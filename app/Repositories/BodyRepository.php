<?php

namespace App\Repositories;

use App\Models\Body;

class BodyRepository
{
	public function create(string $body)
	{
		return Body::create(['name' => $body]);
	}
}
