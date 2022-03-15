<?php

namespace App\Repositories;

use App\Models\Option;

class OptionRepository
{
	/**
	 * Creates a new option
	 *
	 * @param  array $data
	 * @return Option
	 */
	public function create(array $data)
	{
		return Option::create($data);
	}
}
