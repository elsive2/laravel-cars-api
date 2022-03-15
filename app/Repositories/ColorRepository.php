<?php

namespace App\Repositories;

use App\Models\Color;

class ColorRepository
{
	/**
	 * Creates a new color
	 *
	 * @param  string $color
	 * @return Create
	 */
	public function create(string $color)
	{
		return Color::create(['name' => $color]);
	}
}
