<?php

namespace App\Observers;

use App\Models\Car;

class CarObserver
{
	/**
	 * Handle the Car "deleted" event.
	 *
	 * @param  \App\Models\Car  $color
	 * @return void
	 */
	public function deleting(Car $car)
	{
		$car->images()->delete();
	}
}
