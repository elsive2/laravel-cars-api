<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
	/**
	 * Creates a new country
	 *
	 * @param  string $country
	 * @return Country
	 */
	public function create(string $country)
	{
		return Country::create(['name' => $country]);
	}
}
