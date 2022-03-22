<?php

namespace App\Services;

use App\Repositories\imageRepository;

class ImageService extends BaseService
{
	public function __construct(
		private imageRepository $imageRepository
	) {
	}

	public function getById(int $id)
	{
		return $this->imageRepository->getById($id);
	}

	public function addImagesToModel($model, array $imagesIds)
	{
		$images = [];

		foreach ($imagesIds as $id) {
			$image = $this->getById($id);

			if ($image->car) {
				return $this->errValidate("Image number $id is already in use");
			}
			$images[] = $image;
		}

		if ($this->imageRepository->saveImagesToModel($model, $images)) {
			return $this->successMessage('Images have been saved!');
		}
		return $this->errService();
	}
}
