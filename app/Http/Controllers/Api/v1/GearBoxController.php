<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\GearBoxRequest;
use App\Http\Resources\v1\NameResource;
use App\Services\GearBoxService;

class GearBoxController extends Controller
{
	/**
	 * __construct
	 *
	 * @param GearBoxService $gearBoxService
	 * @return void
	 */
	public function __construct(
		private GearBoxService $gearBoxService
	) {
	}

	/**
	 * Display a listing of the gear boxes.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{
		return $this->resultCollection($this->gearBoxService->all(), NameResource::class);
	}

	/**
	 * Display the specified gear box.
	 *
	 * @param  int  $id
	 * @return NameResource
	 */
	public function show(int $id)
	{
		return $this->resultResource($this->gearBoxService->getById($id), NameResource::class);
	}

	/**
	 * Store a newly created gear box in storage.
	 *
	 * @param  GearBoxRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(GearBoxRequest $request)
	{
		return $this->result($this->gearBoxService->create($request->safe()));
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
		return $this->result($this->gearBoxService->update($request->safe(), $id));
	}

	/**
	 * Remove the specified gear box from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		return $this->result($this->gearBoxService->delete($id));
	}
}
