<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\EngineService;
use App\Http\Resources\v1\NameResource;
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
		return $this->resultCollection($this->engineService->all(), NameResource::class);
	}

	/**
	 * Display the specified body.
	 *
	 * @param  int  $id
	 * @return NameResource
	 */
	public function show(int $id)
	{
		return $this->resultResource($this->engineService->getById($id), NameResource::class);
	}

	/**
	 * Store a newly created body in storage.
	 *
	 * @param  EngineRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(EngineRequest $request)
	{
		return $this->result($this->engineService->create($request->safe()));
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
		return $this->result($this->engineService->update($request->safe(), $id));
	}

	/**
	 * Remove the specified body from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		return $this->result($this->engineService->delete($id));
	}
}
