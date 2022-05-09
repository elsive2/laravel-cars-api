<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\ResultService;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $resource;

	/**
	 * @param  ResultService $result
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function result(ResultService $result)
	{
		return response()->json($result->data, $result->code);
	}

	/**
	 * @param  ResultService $result
	 * @return \Illuminate\Http\Resources\Json\JsonResource|\Illuminate\Http\JsonResponse
	 */
	protected function resultResource(ResultService $result)
	{
		if ($result->isSuccess()) {
			return new $this->resource($result->data);
		}
		return $this->result($result);
	}

	/**
	 * @param  ResultService $result
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
	 */
	protected function resultCollection(ResultService $result)
	{
		if ($result->isSuccess()) {
			return $this->resource::collection($result->data);
		}
		return $this->result($result);
	}

	/**
	 * reusltToken
	 *
	 * @param  ResultSerivce $result
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function reusltToken($result)
	{
		if ($result->isSuccess()) {
			return response()->json([
				'access_token' => $result->data,
				'token_type' => 'bearer',
			]);
		}
		return $this->result($result);
	}
}
