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
	 * @param  \Illuminate\Http\Resources\Json\JsonResource $resourceClass
	 * @return \Illuminate\Http\Resources\Json\JsonResource|\Illuminate\Http\JsonResponse
	 */
	protected function resultResource(ResultService $result, $resourceClass)
	{
		if ($result->isSuccess()) {
			return new $resourceClass($result->data);
		}
		return $this->result($result);
	}

	/**
	 * @param  ResultService $result
	 * @param  \Illuminate\Http\Resources\Json\JsonResource	$resourceClass
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
	 */
	protected function resultResources(ResultService $result, $resourceClass)
	{
		if ($result->isSuccess()) {
			return $resourceClass::collection($result->data);
		}
		return $this->result($result);
	}
}
