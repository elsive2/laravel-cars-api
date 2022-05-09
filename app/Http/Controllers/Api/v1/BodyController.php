<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\BodyRequest;
use App\Http\Resources\v1\NameResource;
use App\Services\BodyService;

class BodyController extends Controller
{
	public function __construct(
		private BodyService $bodyService
	) {
	}

	/**
	 * Display a listing of the bodies.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{
		$result = $this->bodyService->all();
		return $this->resultCollection($result, NameResource::class);
	}
	/**
	 * Display the specified body.
	 *
	 * @param  int  $id
	 * @return BodyResource
	 */
	public function show(int $id)
	{
		$result = $this->bodyService->getById($id);
		return $this->resultResource($result, NameResource::class);
	}

	/**
	 * Store a newly created body in storage.
	 *
	 * @param  BodyRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(BodyRequest $request)
	{
		$result = $this->bodyService->create($request->validated());
		return $this->result($result);
	}

	/**
	 * Update the specified body in storage.
	 *
	 * @param  BodyRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(BodyRequest $request, int $id)
	{
		$result = $this->bodyService->update($request->validated(), $id);
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
		$result = $this->bodyService->delete($id);
		return $this->result($result);
	}
}
