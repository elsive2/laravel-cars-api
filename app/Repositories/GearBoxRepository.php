<?php

namespace App\Repositories;

use App\Models\GearBox;

class GearBoxRepository
{
	/**
	 * Creates a new gear box
	 *
	 * @param  string $gearBox
	 * @return GearBox
	 */
	public function create(string $gearBox)
	{
		return GearBox::create(['name' => $gearBox]);
	}
}
