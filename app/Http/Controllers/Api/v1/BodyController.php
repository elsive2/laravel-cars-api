<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\BodyRequest;
use App\Http\Resources\NameResource;
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
		return NameResource::collection($this->bodyService->all());
	}

	/**
	 * Display the specified body.
	 *
	 * @param  int  $id
	 * @return BodyResource
	 */
	public function show(int $id)
	{
		return new NameResource($this->bodyService->getById($id));
	}

	/**
	 * Store a newly created body in storage.
	 *
	 * @param  BodyRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(BodyRequest $request)
	{
		$this->bodyService->create($request->safe());

		return response()->json([
			'data' => 'Body has been created!'
		]);
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
		if ($this->bodyService->update($request->safe(), $id)) {
			return response()->json([
				'data' => 'Body has been updated!'
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
		if ($this->bodyService->delete($id)) {
			return response()->json([
				'data' => 'Body has been deleted!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}
}
