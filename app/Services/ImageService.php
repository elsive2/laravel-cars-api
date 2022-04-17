<?php

namespace App\Services;

use App\Repositories\imageRepository;
use Illuminate\Support\Facades\Storage;

class ImageService extends BaseService
{
	/**
	 * __construct
	 *
	 * @param ImageRepository $imageRepository
	 * @return void
	 */
	public function __construct(
		private imageRepository $imageRepository
	) {
	}

	/**
	 * Get all images
	 *
	 * @return ResultService
	 */
	public function all()
	{
		$images = $this->imageRepository->all();

		if (!$images) {
			return $this->errService();
		}
		return $this->successData($images);
	}

	/**
	 * Get an image by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function getById(int $id)
	{
		$image = $this->imageRepository->getById($id);

		if (is_null($image)) {
			return $this->errNotFound('Image hasn\'t been found!');
		}

		if (!($image instanceof \App\Models\Image)) {
			return $this->errValidate('The element isn\'t an image model!');
		}
		return $this->successData($image);
	}

	/**
	 * Attach all the images to the model
	 *
	 * @param  \Illuminate\Database\Eloquent\Model $model
	 * @param  array<int> $imagesIds
	 * @return ResultService
	 */
	public function addImagesToModel($model, array $imagesIds)
	{
		$images = [];

		foreach ($imagesIds as $id) {
			$image = $this->getById($id);

			if (!$image->isSuccess()) {
				return $image;
			}
			if ($image->data->car) {
				return $this->errValidate("Image number $id is already in use");
			}

			$images[] = $image->data;
		}

		if (!$this->imageRepository->saveImagesToModel($model, $images)) {
			return $this->errService();
		}
		return $this->successMessage('Images have been saved!');
	}

	/**
	 * Create a new image
	 *
	 * @param  \Illuminate\Http\UploadedFile $file
	 * @return ResultService
	 */
	public function create($file)
	{
		$image = $file->storePublicly('images');

		if (!$image) {
			return $this->errValidate('Image hasn\'t been loaded!');
		}

		if (!$this->imageRepository->create($image)) {
			return $this->errService();
		}
		return $this->successData($image);
	}

	/**
	 * Delete an image by its id
	 *
	 * @param  int $id
	 * @return ResultService
	 */
	public function delete(int $id)
	{
		$image = $this->getById($id);

		if (!$image->isSuccess()) {
			return $image;
		}
		$this->imageRepository->delete($image->data);

		return $this->successMessage('Image has been deleted!');
	}

	/**
	 * Delete all the images from the model
	 *
	 * @param  \Illuminate\Database\Eloquent\Model $model
	 * @return ResultService
	 */
	public function deleteAllFrom($model)
	{
		$this->imageRepository->deleteAllFrom($model);

		return $this->successMessage('Images have been deleted!');
	}
}
