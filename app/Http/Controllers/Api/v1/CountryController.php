<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\CountryRequest;
use App\Http\Resources\v1\NameResource;
use App\Services\CountryService;

class CountryController extends Controller
{
	public function __construct(
		private CountryService $countryService
	) {
	}

	/**
	 * Display a listing of the countries.
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{
		$result = $this->countryService->all();
		return $this->resultCollection($result, NameResource::class);
	}

	/**
	 * Display the specified country.
	 *
	 * @param  int  $id
	 * @return CountryResource
	 */
	public function show(int $id)
	{
		$result = $this->countryService->getById($id);
		return $this->resultResource($result, NameResource::class);
	}

	/**
	 * Store a newly created country in storage.
	 *
	 * @param  CountryRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CountryRequest $request)
	{
		$result = $this->countryService->create($request->validated());
		return $this->result($result);
	}

	/**
	 * Update the specified country in storage.
	 *
	 * @param  CountryRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(CountryRequest $request, int $id)
	{
		$result = $this->countryService->update($request->validated(), $id);
		return $this->result($result);
	}

	/**
	 * Remove the specified country from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		$result = $this->countryService->delete($id);
		return $this->result($result);
	}
}
