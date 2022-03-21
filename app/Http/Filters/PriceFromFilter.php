<?php

namespace App\Http\Filters;

class PriceFromFilter implements QueryFilter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	public function getFilterName()
	{
		return 'price.from';
	}

	/**
	 * Apply the filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder)
	{
		return $builder->where('price', '>', request($this->getFilterName()));
	}
}
