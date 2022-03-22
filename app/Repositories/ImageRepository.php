<?php

namespace App\Repositories;

use App\Models\Image;

class imageRepository
{
	public function getById(int $id)
	{
		return Image::find($id);
	}

	public function saveImagesToModel($model, $images)
	{
		return $model->images()->saveMany($images);
	}
}
