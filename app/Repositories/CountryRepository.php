<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
	/**
	 * Get a country by its name
	 *
	 * @param  string $country
	 * @return Country
	 */
	public function getByName(string $country)
	{
		return Country::whereName($country)->first();
	}
}
