<?php

namespace App\Http\Controllers;

use App\Http\Requests\GearBoxRequest;
use App\Http\Resources\NameResource;
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
		return NameResource::collection($this->gearBoxService->all());
	}

	/**
	 * Display the specified gear box.
	 *
	 * @param  int  $id
	 * @return NameResource
	 */
	public function show(int $id)
	{
		return new NameResource($this->gearBoxService->getById($id));
	}

	/**
	 * Store a newly created gear box in storage.
	 *
	 * @param  GearBoxRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(GearBoxRequest $request)
	{
		$this->gearBoxService->create($request->safe());

		return response()->json([
			'data' => 'Gear Box has been created!'
		]);
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
		if ($this->gearBoxService->update($request->safe(), $id)) {
			return response()->json([
				'data' => 'Gear Box has been updated!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}

	/**
	 * Remove the specified gear box from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		if ($this->gearBoxService->delete($id)) {
			return response()->json([
				'data' => 'Gear Box has been deleted!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}
}
