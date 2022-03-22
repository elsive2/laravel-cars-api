<?php

namespace App\Repositories;

use App\Models\Image;

class imageRepository
{
	/**
	 * Get all images
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return Image::all();
	}

	/**
	 * Get an image by its id
	 *
	 * @param  int $id
	 * @return Image
	 */
	public function getById(int $id)
	{
		return Image::find($id);
	}

	/**
	 * Attach all the images to the model
	 *
	 * @param  \Illuminate\Database\Eloquent\Model $model
	 * @param  array<Image> $images
	 * @return array<Image>
	 */
	public function saveImagesToModel($model, $images)
	{
		return $model->images()->saveMany($images);
	}

	/**
	 * Create an image
	 *
	 * @param  string $path
	 * @return void
	 */
	public function create(string $path)
	{
		return Image::create(['name' => $path]);
	}

	/**
	 * Delete the image
	 *
	 * @param  Image $image
	 * @return bool|null
	 */
	public function delete(Image $image)
	{
		return $image->delete();
	}
}
