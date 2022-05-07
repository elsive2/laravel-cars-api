<?php

namespace App\Http\Filters;

class PriceToFilter implements QueryFilter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	public function getFilterName()
	{
		return 'price.to';
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
		return $builder->where('price', '<', $value);
	}
}
