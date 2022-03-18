<?php

namespace App\Observers;

use App\Models\GearBox;

class GearBoxObserver
{
	/**
	 * Handle the GearBox "deleted" event.
	 *
	 * @param  \App\Models\GearBox  $gearBox
	 * @return void
	 */
	public function deleting(GearBox $gearBox)
	{
		$gearBox->options()->update([
			'gear_box_id' => null
		]);
	}
}
