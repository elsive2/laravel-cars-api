<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
	/**
	 * Get all brands
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return Brand::all();
	}

	/**
	 * Get a brand by its id
	 *
	 * @param  int $id
	 * @return Brand|null
	 */
	public function getById(int $id)
	{
		return Brand::find($id);
	}

	/**
	 * Create a new brand
	 *
	 * @param  array $data
	 * @return Brand
	 */
	public function create(array $data)
	{
		return Brand::create($data);
	}

	/**
	 * Update the brand
	 *
	 * @param  array $data
	 * @param  Brand $Brand
	 * @return bool
	 */
	public function update(array $data, Brand $brand)
	{
		return $brand->update($data);
	}

	/**
	 * Delete the brand
	 *
	 * @param  Brand $brand
	 * @return bool|null
	 */
	public function delete(Brand $brand)
	{
		return $brand->delete();
	}
}
