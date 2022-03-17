<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Http\Resources\NameResource;
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
		return NameResource::collection($this->countryService->all());
	}

	/**
	 * Display the specified country.
	 *
	 * @param  int  $id
	 * @return CountryResource
	 */
	public function show(int $id)
	{
		return new NameResource($this->countryService->getById($id));
	}

	/**
	 * Store a newly created country in storage.
	 *
	 * @param  CountryRequest  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CountryRequest $request)
	{
		$this->countryService->create($request->safe());

		return response()->json([
			'data' => 'Country has been created!'
		]);
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
		if ($this->countryService->update($request->safe(), $id)) {
			return response()->json([
				'data' => 'Country has been updated!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}

	/**
	 * Remove the specified country from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id)
	{
		if ($this->countryService->delete($id)) {
			return response()->json([
				'data' => 'Country has been deleted!'
			]);
		}
		return response()->json([
			'data' => 'Something went wrong!'
		]);
	}
}
