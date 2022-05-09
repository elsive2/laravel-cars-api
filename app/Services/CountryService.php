<?php

namespace App\Services;

use App\Repositories\CountryRepository;

class CountryService extends BaseService
{
	public function __construct(
		private CountryRepository $countryRepository
	) {
	}

	/**
	 * Get all countries
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$countries = $this->countryRepository->all();
		return $this->successData($countries);
	}

	/**
	 * Get a country by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function getById(int $id)
	{
		$country = $this->countryRepository->getById($id);

		if (is_null($country)) {
			return $this->errNotFound();
		}
		return $this->successData($country);
	}

	/**
	 * Create a country
	 *
	 * @param  array $data
	 * @return ResultService
	 */
	public function create(array $data)
	{
		$this->countryRepository->create($data);
		return $this->successMessage(__('api.country.created'));
	}

	/**
	 * Update a country by its id
	 *
	 * @param  array $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update(array $data, int $id)
	{
		$country = $this->getById($id);

		if (!$country->isSuccess()) {
			return $country;
		}
		$this->countryRepository->update($data, $country->data);
		return $this->successMessage(__('api.country.updated'));
	}

	/**
	 * Delete a country by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$country = $this->getById($id);

		if (!$country->isSuccess()) {
			return $country;
		}
		$this->countryRepository->delete($country->data);
		return $this->successMessage(__('api.country.deleted'));
	}
}
