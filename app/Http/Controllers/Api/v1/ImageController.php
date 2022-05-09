<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ImageRequest;
use App\Http\Resources\v1\ImageResource;
use App\Services\ImageService;

class ImageController extends Controller
{
	public function __construct(
		private ImageService $imageService,
	) {
	}

	/**
	 * Display a listing of the images.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$result = $this->imageService->all();
		return $this->resultCollection($result, ImageResource::class);
	}

	/**
	 * Display the specified image.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(int $id)
	{
		$result = $this->imageService->getById($id);
		return $this->resultResource($result, ImageResource::class);
	}

	/**
	 * Store a newly created image in storage.
	 *
	 * @param  ImageRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ImageRequest $request)
	{
		$result = $this->imageService->create($request->file('image'));
		return $this->resultResource($result, ImageResource::class);
	}

	/**
	 * Remove the specified image from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(int $id)
	{
		$result = $this->imageService->delete($id);
		return $this->result($result);
	}
}
