<?php

namespace App\Repositories;

use App\Models\Option;

class OptionRepository
{
	public function create(array $data)
	{
		return Option::create($data);
	}
}
