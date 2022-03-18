<?php

namespace App\Observers;

use App\Models\Brand;

class BrandObserver
{
	/**
	 * Handle the Brand "deleted" event.
	 *
	 * @param  \App\Models\Brand  $brand
	 * @return void
	 */
	public function deleting(Brand $brand)
	{
		$brand->cars()->update([
			'brand_id' => null
		]);
	}
}
