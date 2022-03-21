<?php

namespace App\Http\Filters;

class ModelFilter extends Filter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	protected function getFilterName()
	{
		return 'model';
	}

	/**
	 * Apply the filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	protected function applyFilter($builder)
	{
		return $builder->where('model', 'like', '%' . $this->getFilterValue() . '%');
	}
}
