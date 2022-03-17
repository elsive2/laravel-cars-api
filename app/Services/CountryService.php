<?php

namespace App\Services;

use App\Repositories\CountryRepository;

class CountryService
{
	/**
	 * __construct
	 *
	 * @param CountryRepository $countryRepository
	 * @return void
	 */
	public function __construct(
		private CountryRepository $countryRepository
	) {
	}

	/**
	 * Get all the countries
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return $this->countryRepository->all();
	}

	/**
	 * Get a country by its id
	 *
	 * @param  int $id
	 * @return \App\Models\Country
	 */
	public function getById(int $id)
	{
		$country = $this->countryRepository->getById($id);

		abort_if(is_null($country), 404);

		return $country;
	}

	/**
	 * Create a country
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return \App\Models\Country
	 */
	public function create($data)
	{
		return $this->countryRepository->create($data->toArray());
	}

	/**
	 * Update a country by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return bool
	 */
	public function update($data, int $id)
	{
		$country = $this->getById($id);

		return $this->countryRepository->update($data->toArray(), $country);
	}

	/**
	 * Delete a country by its id
	 *
	 * @param  int $id
	 * @return bool|null
	 */
	public function delete(int $id)
	{
		$country = $this->getById($id);

		return $this->countryRepository->delete($country);
	}
}
