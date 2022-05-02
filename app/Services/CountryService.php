<?php

namespace App\Services;

use App\Repositories\CountryRepository;

class CountryService extends BaseService
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
	 * Get all countries
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$countries = $this->countryRepository->all();

		if (!$countries) {
			return $this->errService();
		}
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

		if (!($country instanceof \App\Models\Country)) {
			return $this->errValidate(__('api.country.not_country_model'));
		}
		return $this->successData($country);
	}

	/**
	 * Create a country
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return ResultService
	 */
	public function create($data)
	{
		$country = $this->countryRepository->create($data->toArray());

		if (!($country instanceof \App\Models\Country)) {
			return $this->errValidate(__('api.country.not_country_model'));
		}

		if (!$country) {
			return $this->errService();
		}
		return $this->successMessage(__('api.country.created'));
	}

	/**
	 * Update a country by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return ResultService
	 */
	public function update($data, int $id)
	{
		$country = $this->getById($id);

		if (!$country->isSuccess()) {
			return $country;
		}

		$isUpdated = $this->countryRepository->update($data->toArray(), $country->data);

		if (!$isUpdated) {
			return $this->errService();
		}
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
