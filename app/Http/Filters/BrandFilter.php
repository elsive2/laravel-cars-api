<?php

namespace App\Http\Filters;

class BrandFilter implements QueryFilter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	public function getFilterName()
	{
		return 'brand';
	}

	/**
	 * Apply the filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @param  mixed $value
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder, $value)
	{
		return $builder->whereRelation('brand', function ($subQuery) use ($value) {
			$subQuery->whereIn('name', $value);
		});
	}
}
