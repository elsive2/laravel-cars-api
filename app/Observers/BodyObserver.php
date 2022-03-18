<?php

namespace App\Observers;

use App\Models\Body;

class BodyObserver
{
	/**
	 * Handle the Body "deleted" event.
	 *
	 * @param  \App\Models\Body  $body
	 * @return void
	 */
	public function deleting(Body $body)
	{
		$body->options()->update([
			'body_id' => null
		]);
	}
}
