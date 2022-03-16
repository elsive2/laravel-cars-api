<?php

namespace App\Http\Controllers;

use App\Services\EngineService;
use App\Http\Resources\NameResource;
use App\Http\Requests\EngineRequest;

class EngineController extends Controller
{
	/**
	 * __construct
	 *
	 * @param EngineService $engineService
	 * @return void
	 */
	public function __construct(
		private EngineService $engineService
	) {
	}

	/**
	 * Display a listing of the bodies.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{

		return NameResource::collection($this->engineService->all());
	}

	/**
	 * Display the specified body.
	 *
	 * @param  int  $id
	 * @return NameResource
	 */
	public function show(int $id)
	{
		return new NameResource($this->engineService->getById($id));
	}

	/**
	 * Store a newly created body in storage.
	 *
	 * @param  EngineRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(EngineRequest $request)
	{
		$this->engineService->create($request->safe());

		return response()->json([
			'data' => 'Engine has been created!'
		]);
	}

	/**
	 * Update the specified body in storage.
	 *
	 * @param  EngineRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(EngineRequest $request, int $id)
	{
		if ($this->engineService->update($request->safe(), $id)) {
			return response()->json([
				'data' => 'Engine has been updated!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}

	/**
	 * Remove the specified body from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		if ($this->engineService->delete($id)) {
			return response()->json([
				'data' => 'Engine has been deleted!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}
}
