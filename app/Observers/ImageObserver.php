<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{
	/**
	 * Handle the Image "deleted" event.
	 *
	 * @param  \App\Models\Image  $image
	 * @return void
	 */
	public function deleted(Image $image)
	{
		Storage::delete($image->name);
	}
}
