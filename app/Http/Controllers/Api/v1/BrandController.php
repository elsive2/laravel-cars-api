<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\BrandRequest;
use App\Http\Resources\v1\NameResource;
use App\Services\BrandService;

class BrandController extends Controller
{
	/**
	 * __construct
	 *
	 * @param BrandService $brandService
	 * @return void
	 */
	public function __construct(
		private BrandService $brandService
	) {
	}

	/**
	 * Display a listing of the brands.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{
		return NameResource::collection($this->brandService->all());
	}

	/**
	 * Display the specified brand.
	 *
	 * @param  int  $id
	 * @return BrandResource
	 */
	public function show(int $id)
	{
		return new NameResource($this->brandService->getById($id));
	}

	/**
	 * Store a newly created brand in storage.
	 *
	 * @param  BrandRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(BrandRequest $request)
	{
		$this->brandService->create($request->safe());

		return response()->json([
			'data' => 'Brand has been created!'
		]);
	}

	/**
	 * Update the specified brand in storage.
	 *
	 * @param  BrandRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(BrandRequest $request, int $id)
	{
		if ($this->brandService->update($request->safe(), $id)) {
			return response()->json([
				'data' => 'Brand has been updated!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}

	/**
	 * Remove the specified brand from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		if ($this->brandService->delete($id)) {
			return response()->json([
				'data' => 'Brand has been deleted!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}
}
