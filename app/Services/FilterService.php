<?php

namespace App\Services;

class FilterService
{
	/**
	 * Method that starts filtering
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @param  array<\App\Http\Filters\QueryFilter> $filters
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public static function handle($builder, array $filters)
	{
		foreach ($filters as $filter) {
			if (request()->has($filter->getFilterName()) && request($filter->getFilterName())) {
				$builder = $filter->handle($builder);
			}
		}
		return $builder->get();
	}
}
