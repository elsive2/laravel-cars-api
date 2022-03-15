<?php

namespace App\Repositories;

use App\Models\Color;

class ColorRepository
{
	/**
	 * Get a color by its name
	 *
	 * @param  string $color
	 * @return Color
	 */
	public function getByName(string $color)
	{
		return Color::whereName($color)->first();
	}
}
