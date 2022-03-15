<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
	/**
	 * Get a brand by its name
	 *
	 * @param  string $brand
	 * @return Brand
	 */
	public function getByName(string $brand)
	{
		return Brand::whereName($brand)->first();
	}
}
