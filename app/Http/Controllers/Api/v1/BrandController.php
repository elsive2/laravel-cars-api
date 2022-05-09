<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\BrandRequest;
use App\Http\Resources\v1\NameResource;
use App\Services\BrandService;

class BrandController extends Controller
{
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
		$result = $this->brandService->all();
		return $this->resultCollection($result, NameResource::class);
	}

	/**
	 * Display the specified brand.
	 *
	 * @param  int  $id
	 * @return BrandResource
	 */
	public function show(int $id)
	{
		$result = $this->brandService->getById($id);
		return $this->resultResource($result, NameResource::class);
	}

	/**
	 * Store a newly created brand in storage.
	 *
	 * @param  BrandRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(BrandRequest $request)
	{
		$result = $this->brandService->create($request->validated());
		return $this->result($result);
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
		$result = $this->brandService->update($request->validated(), $id);
		return $this->result($result);
	}

	/**
	 * Remove the specified brand from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		$result = $this->brandService->delete($id);
		return $this->result($result);
	}
}
