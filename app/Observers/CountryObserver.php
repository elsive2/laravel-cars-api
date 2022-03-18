<?php

namespace App\Observers;

use App\Models\Country;

class CountryObserver
{
	/**
	 * Handle the Country "deleted" event.
	 *
	 * @param  \App\Models\Country  $country
	 * @return void
	 */
	public function deleting(Country $country)
	{
		$country->cars()->update([
			'country_id' => null
		]);
	}
}
