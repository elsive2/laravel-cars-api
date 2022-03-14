<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
	public function create(string $country)
	{
		return Country::create(['name' => $country]);
	}
}
