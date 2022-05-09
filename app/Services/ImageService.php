<?php

namespace App\Services;

use App\Repositories\imageRepository;

class ImageService extends BaseService
{
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
			return $this->errNotFound(__('api.image.not_found'));
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
			if (!is_null($image->data->car_id)) {
				return $this->errValidate(__('api.image.used', ['id' => $id]));
			}
			$images[] = $image->data;
		}
		$this->imageRepository->saveImagesToModel($model, $images);
		return $this->successMessage(__('api.image.saved'));
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
		return $this->successData($this->imageRepository->create($image));
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
		return $this->successMessage(__('api.image.deleted'));
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
		return $this->successMessage(__('api.image.deleted_plural'));
	}
}
