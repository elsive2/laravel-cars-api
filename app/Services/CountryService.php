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
			return $this->errValidate('The element isn\'t a country model!');
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
			return $this->errValidate('The element isn\'t a country model!');
		}

		if (!$country) {
			return $this->errService();
		}
		return $this->successMessage('Country has been created!');
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
		$isUpdated = $this->countryRepository->update($data->toArray(), $this->getById($id)->data);

		if (!$isUpdated) {
			return $this->errService();
		}
		return $this->successMessage('Country has been updated!');
	}

	/**
	 * Delete a country by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$this->countryRepository->delete($this->getById($id)->data);

		return $this->successMessage('Country has been deleted!');
	}
}
