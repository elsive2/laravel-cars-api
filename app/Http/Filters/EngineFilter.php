<?php

namespace App\Http\Filters;

class EngineFilter implements QueryFilter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	public function getFilterName()
	{
		return 'engine';
	}

	/**
	 * Apply the filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder)
	{
		return $builder->whereRelation('options.engine', 'name', request($this->getFilterName()));
	}
}
