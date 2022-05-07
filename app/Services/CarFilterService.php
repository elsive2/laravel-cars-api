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
			new \App\Http\Filters\EngineCapacityToFilter,
			new \App\Http\Filters\EngineCapacityFromFilter,
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
	 * @param  array $data
	 * @return \Illuminate\Pagination\LengthAwarePaginator
	 */
	public static function handle($builder, $data)
	{
		foreach (self::getCarFilters() as $filter) {
			foreach ($data as $filterName => $filterValue) {

				if (is_array($filterValue)) {
					foreach ($filterValue as $subFilterName => $subFilterValue) {
						if ($filterName . '.' . $subFilterName == $filter->getFilterName()) {
							$builder = $filter->handle($builder, $subFilterValue);
						}
					}
				}

				if ($filterName == $filter->getFilterName()) {
					$builder = $filter->handle($builder, $filterValue);
				}
			}
		}
		return self::applySortAndPaginate($builder, $data);
	}

	/**
	 * Apply the order of sorting and paginate to the result (builder)
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @param  array $data
	 * @return \Illuminate\Pagination\LengthAwarePaginator
	 */
	private static function applySortAndPaginate($builder, $data)
	{
		$sort 		= isset($data['sort']) ? $data['sort'] : config('api.cars.sort');
		$order 		= isset($data['order']) ? $data['order'] : config('api.cars.order');
		$per_page	= isset($data['per_page']) ? $data['per_page'] : config('api.cars.per_page');

		return $builder->orderBy($sort, $order)
			->paginate($per_page);
	}
}
