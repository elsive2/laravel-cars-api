<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\BodyRequest;
use App\Http\Resources\v1\NameResource;
use App\Services\BodyService;

class BodyController extends Controller
{
	/**
	 * __construct
	 *
	 * @param BodyService $bodyService
	 * @return void
	 */
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
		return $this->resultCollection($this->bodyService->all(), NameResource::class);
	}
	/**
	 * Display the specified body.
	 *
	 * @param  int  $id
	 * @return BodyResource
	 */
	public function show(int $id)
	{
		return $this->resultResource($this->bodyService->getById($id), NameResource::class);
	}

	/**
	 * Store a newly created body in storage.
	 *
	 * @param  BodyRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(BodyRequest $request)
	{
		return $this->result($this->bodyService->create($request->safe()));
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
		return $this->result($this->bodyService->update($request->safe(), $id));
	}

	/**
	 * Remove the specified body from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		return $this->result($this->bodyService->delete($id));
	}
}
