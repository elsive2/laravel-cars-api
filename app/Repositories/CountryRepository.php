<?php

namespace App\Repositories;

use App\Models\Country;
use Illuminate\Support\Facades\Schema;

class CountryRepository
{
	/**
	 * Get all the countrys
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return Country::all();
	}

	/**
	 * Get a country by its id
	 *
	 * @param  int $id
	 * @return Country|null
	 */
	public function getById(int $id)
	{
		return Country::find($id);
	}

	/**
	 * Create a new Country
	 *
	 * @param  array $data
	 * @return Country
	 */
	public function create(array $data)
	{
		return Country::create($data);
	}

	/**
	 * Update the country
	 *
	 * @param  array $data
	 * @param  Country $Country
	 * @return bool
	 */
	public function update(array $data, Country $country)
	{
		return $country->update($data);
	}

	/**
	 * Delete the country
	 *
	 * @param  Country $country
	 * @return bool|null
	 */
	public function delete(Country $country)
	{
		return $country->delete();
	}
}
