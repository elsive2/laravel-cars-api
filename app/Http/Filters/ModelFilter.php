<?php

namespace App\Http\Filters;

class ModelFilter implements QueryFilter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	public function getFilterName()
	{
		return 'model';
	}

	/**
	 * Apply the filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder)
	{
		return $builder->where('model', 'like', '%' . request($this->getFilterName()) . '%');
	}
}
