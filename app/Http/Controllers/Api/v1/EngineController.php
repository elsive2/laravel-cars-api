<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\EngineService;
use App\Http\Resources\v1\NameResource;
use App\Http\Requests\EngineRequest;

class EngineController extends Controller
{
	public function __construct(private EngineService $engineService)
	{
		$this->resource = NameResource::class;
	}

	/**
	 * Display a listing of the bodies.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{
		$result = $this->engineService->all();
		return $this->resultCollection($result);
	}

	/**
	 * Display the specified body.
	 *
	 * @param  int  $id
	 * @return NameResource
	 */
	public function show(int $id)
	{
		$result = $this->engineService->getById($id);
		return $this->resultResource($result);
	}

	/**
	 * Store a newly created body in storage.
	 *
	 * @param  EngineRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(EngineRequest $request)
	{
		$result = $this->engineService->create($request->validated());
		return $this->result($result);
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
		$result = $this->engineService->update($request->validated(), $id);
		return $this->result($result);
	}

	/**
	 * Remove the specified body from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		$result = $this->engineService->delete($id);
		return $this->result($result);
	}
}
