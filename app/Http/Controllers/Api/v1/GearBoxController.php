<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\GearBoxRequest;
use App\Http\Resources\v1\NameResource;
use App\Services\GearBoxService;

class GearBoxController extends Controller
{
	public function __construct(private GearBoxService $gearBoxService)
	{
		$this->resource = NameResource::class;
	}

	/**
	 * Display a listing of the gear boxes.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{
		$result = $this->gearBoxService->all();
		return $this->resultCollection($result);
	}

	/**
	 * Display the specified gear box.
	 *
	 * @param  int  $id
	 * @return NameResource
	 */
	public function show(int $id)
	{
		$result = $this->gearBoxService->getById($id);
		return $this->resultResource($result);
	}

	/**
	 * Store a newly created gear box in storage.
	 *
	 * @param  GearBoxRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(GearBoxRequest $request)
	{
		$result = $this->gearBoxService->create($request->validated());
		return $this->result($result);
	}

	/**
	 * Update the specified gear box in storage.
	 *
	 * @param  GearBoxRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(GearBoxRequest $request, int $id)
	{
		$result = $this->gearBoxService->update($request->validated(), $id);
		return $this->result($result);
	}

	/**
	 * Remove the specified gear box from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		$result = $this->gearBoxService->delete($id);
		return $this->result($result);
	}
}
