<?php

namespace App\Observers;

use App\Models\Engine;

class EngineObserver
{
	/**
	 * Handle the Engine "deleted" event.
	 *
	 * @param  \App\Models\Engine  $engine
	 * @return void
	 */
	public function deleting(Engine $engine)
	{
		$engine->options()->update([
			'engine_id' => null
		]);
	}
}
