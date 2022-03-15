<?php

namespace App\Repositories;

use App\Models\GearBox;

class GearBoxRepository
{
	/**
	 * Get a gear box by its name
	 *
	 * @param  string $gearBox
	 * @return GearBox
	 */
	public function getByName(string $gearBox)
	{
		return GearBox::whereName($gearBox)->first();
	}
}
