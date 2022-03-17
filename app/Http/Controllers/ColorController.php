<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Http\Resources\NameResource;
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
		return NameResource::collection($this->colorService->all());
	}

	/**
	 * Display the specified color.
	 *
	 * @param  int  $id
	 * @return ColorResource
	 */
	public function show(int $id)
	{
		return new NameResource($this->colorService->getById($id));
	}

	/**
	 * Store a newly created color in storage.
	 *
	 * @param  ColorRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(ColorRequest $request)
	{
		$this->colorService->create($request->safe());

		return response()->json([
			'data' => 'Color has been created!'
		]);
	}

	/**
	 * Update the specified color in storage.
	 *
	 * @param  ColorRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(ColorRequest $request, int $id)
	{
		if ($this->colorService->update($request->safe(), $id)) {
			return response()->json([
				'data' => 'Color has been updated!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}

	/**
	 * Remove the specified color from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		if ($this->colorService->delete($id)) {
			return response()->json([
				'data' => 'Color has been deleted!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}
}
