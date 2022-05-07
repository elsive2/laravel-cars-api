<?php

namespace App\Services;

abstract class FilterService
{
	/**
	 * Get all the filters
	 *
	 * @return array<\App\Http\Filters\QueryFilter>
	 */
	public static function filters()
	{
		return [];
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
		foreach (static::filters() as $filter) {
			$filter = new $filter;
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
		$sort 		= isset($data['sort']) 		? $data['sort'] 	: config('api.sort');
		$order 		= isset($data['order']) 	? $data['order'] 	: config('api.order');
		$per_page	= isset($data['per_page']) 	? $data['per_page'] : config('api.per_page');

		return $builder->orderBy($sort, $order)
			->paginate($per_page);
	}
}
