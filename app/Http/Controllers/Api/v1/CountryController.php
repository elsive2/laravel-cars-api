<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\CountryRequest;
use App\Http\Resources\v1\NameResource;
use App\Services\CountryService;

class CountryController extends Controller
{
	/**
	 * __construct
	 *
	 * @param CountryService $countryService
	 * @return void
	 */
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
		return $this->resultCollection($this->countryService->all(), NameResource::class);
	}

	/**
	 * Display the specified country.
	 *
	 * @param  int  $id
	 * @return CountryResource
	 */
	public function show(int $id)
	{
		return $this->resultResource($this->countryService->getById($id), NameResource::class);
	}

	/**
	 * Store a newly created country in storage.
	 *
	 * @param  CountryRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CountryRequest $request)
	{
		return $this->result($this->countryService->create($request->safe()));
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
		return $this->result($this->countryService->update($request->safe(), $id));
	}

	/**
	 * Remove the specified country from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		return $this->result($this->countryService->delete($id));
	}
}
