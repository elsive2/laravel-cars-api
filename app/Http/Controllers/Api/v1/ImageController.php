<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\v1\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\v1\ImageResource;
use App\Services\ImageService;

class ImageController extends Controller
{
	/**
	 * __construct
	 *
	 * @param ImageService $imageService
	 * @return void
	 */
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
		return $this->resultCollection($this->imageService->all(), ImageResource::class);
	}

	/**
	 * Display the specified image.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(int $id)
	{
		return $this->resultResource($this->imageService->getById($id), ImageResource::class);
	}

	/**
	 * Store a newly created image in storage.
	 *
	 * @param  ImageRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ImageRequest $request)
	{
		return $this->result($this->imageService->create($request->file('image')));
	}

	/**
	 * Remove the specified image from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(int $id)
	{
		return $this->result($this->imageService->delete($id));
	}
}
