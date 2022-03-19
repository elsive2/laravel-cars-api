<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ColorStoreRequest;
use App\Http\Requests\ColorUpdateRequest;
use App\Http\Resources\v1\ColorResource;
use App\Services\ColorService;

class ColorController extends Controller
{
	/**
	 * __construct
	 *
	 * @param ColorService $colorService
	 * @return void
	 */
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
		return $this->resultCollection($this->colorService->all(), ColorResource::class);
	}

	/**
	 * Display the specified color.
	 *
	 * @param  int  $id
	 * @return ColorResource
	 */
	public function show(int $id)
	{
		return $this->resultResource($this->colorService->getById($id), ColorResource::class);
	}

	/**
	 * Store a newly created color in storage.
	 *
	 * @param  ColorStoreRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(ColorStoreRequest $request)
	{
		return $this->result($this->colorService->create($request->safe()));
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
		return $this->result($this->colorService->update($request->safe(), $id));
	}

	/**
	 * Remove the specified color from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		return $this->result($this->colorService->delete($id));
	}
}
