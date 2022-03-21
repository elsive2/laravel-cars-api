<?php

namespace App\Http\Filters;

class GearBoxFilter implements QueryFilter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	public function getFilterName()
	{
		return 'gear_box';
	}

	/**
	 * Apply the filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder)
	{
		return $builder->whereRelation('options.gearBox', 'name', request($this->getFilterName()));
	}
}
