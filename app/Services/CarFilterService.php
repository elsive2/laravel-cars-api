<?php

namespace App\Services;

class CarFilterService
{
	/**
	 * Get all the car filters
	 *
	 * @return array<\App\Http\Filters\QueryFilter>
	 */
	private static function getCarFilters()
	{
		return [
			new \App\Http\Filters\ModelFilter,
			new \App\Http\Filters\TypeFilter,
			new \App\Http\Filters\PriceFromFilter,
			new \App\Http\Filters\PriceToFilter,
			new \App\Http\Filters\YearFromFilter,
			new \App\Http\Filters\YearToFilter,
			new \App\Http\Filters\IsWorkingFilter,
			new \App\Http\Filters\IsActiveFilter,
			new \App\Http\Filters\DriveUnitFilter,
			new \App\Http\Filters\WheelPositionFilter,
			new \App\Http\Filters\MileageFromFilter,
			new \App\Http\Filters\MileageToFilter,
			new \App\Http\Filters\EngineCapacityFilter,
			new \App\Http\Filters\BodyFilter,
			new \App\Http\Filters\EngineFilter,
			new \App\Http\Filters\GearBoxFilter,
			new \App\Http\Filters\ColorFIlter,
			new \App\Http\Filters\ColorMetalicFilter,
			new \App\Http\Filters\CountryFilter,
			new \App\Http\Filters\BrandFilter,
		];
	}

	/**
	 * Method that starts filtering
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @param  array<\App\Http\Filters\QueryFilter> $filters
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public static function handle($builder)
	{
		foreach (self::getCarFilters() as $filter) {
			if (request()->has($filter->getFilterName()) && request($filter->getFilterName())) {
				$builder = $filter->handle($builder);
			}
		}
		return $builder->orderBy(
			request('sort') ?: config('api.cars.sort'),
			request('order') ?: config('api.cars.order')
		)->paginate(request('per_page') ?: config('api.cars.per_page'));
	}
}
