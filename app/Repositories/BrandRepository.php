<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
	public function create(string $brand)
	{
		return Brand::create(['name' => $brand]);
	}
}
