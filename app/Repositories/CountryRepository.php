<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
	/**
	 * Get all the countries
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
	 * Create a new сountry
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
	 * @param  Country $сountry
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
