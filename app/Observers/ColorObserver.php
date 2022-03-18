<?php

namespace App\Observers;

use App\Models\Color;

class ColorObserver
{
	/**
	 * Handle the Color "deleted" event.
	 *
	 * @param  \App\Models\Color  $color
	 * @return void
	 */
	public function deleting(Color $color)
	{
		$color->options()->update([
			'color_id' => null
		]);
	}
}
