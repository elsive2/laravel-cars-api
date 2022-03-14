<?php

namespace App\Repositories;

use App\Models\Color;

class ColorRepository
{
	public function create(string $color)
	{
		return Color::create(['name' => $color]);
	}
}
