<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
	/**
	 * Creates a new brand
	 *
	 * @param  string $brand
	 * @return Brand
	 */
	public function create(string $brand)
	{
		return Brand::create(['name' => $brand]);
	}
}
