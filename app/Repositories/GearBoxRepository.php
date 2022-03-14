<?php

namespace App\Repositories;

use App\Models\GearBox;

class GearBoxRepository
{
	public function create(string $gearBox)
	{
		return GearBox::create(['name' => $gearBox]);
	}
}
