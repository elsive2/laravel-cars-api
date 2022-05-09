<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ColorStoreRequest;
use App\Http\Requests\ColorUpdateRequest;
use App\Http\Resources\v1\ColorResource;
use App\Services\ColorService;

class ColorController extends Controller
{
	public function __construct(
		private ColorService $colorService
	) {
	}

	/**
	 * Display a listing of the colors.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{
		$result = $this->colorService->all();
		return $this->resultCollection($result, ColorResource::class);
	}

	/**
	 * Display the specified color.
	 *
	 * @param  int  $id
	 * @return ColorResource
	 */
	public function show(int $id)
	{
		$result = $this->colorService->getById($id);
		return $this->resultResource($result, ColorResource::class);
	}

	/**
	 * Store a newly created color in storage.
	 *
	 * @param  ColorStoreRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(ColorStoreRequest $request)
	{
		$result = $this->colorService->create($request->validated());
		return $this->result($result);
	}

	/**
	 * Update the specified color in storage.
	 *
	 * @param  ColorRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(ColorUpdateRequest $request, int $id)
	{
		$result = $this->colorService->update($request->validated(), $id);
		return $this->result($result);
	}

	/**
	 * Remove the specified color from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		$result = $this->colorService->delete($id);
		return $this->result($result);
	}
}
