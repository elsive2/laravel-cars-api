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
		return $this->resultCollection($this->brandService->all(), NameResource::class);
	}

	/**
	 * Display the specified brand.
	 *
	 * @param  int  $id
	 * @return BrandResource
	 */
	public function show(int $id)
	{
		return $this->resultResource($this->brandService->getById($id), NameResource::class);
	}

	/**
	 * Store a newly created brand in storage.
	 *
	 * @param  BrandRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(BrandRequest $request)
	{
		return $this->result($this->brandService->create($request->safe()));
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
		return $this->result($this->brandService->update($request->safe(), $id));
	}

	/**
	 * Remove the specified brand from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		return $this->result($this->brandService->delete($id));
	}
}
