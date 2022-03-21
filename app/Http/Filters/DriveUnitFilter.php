<?php

namespace App\Http\Filters;

class DriveUnitFilter implements QueryFilter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	public function getFilterName()
	{
		return 'drive_unit';
	}

	/**
	 * Apply the filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder)
	{
		return $builder->whereRelation('options', 'drive_unit', request($this->getFilterName()));
	}
}
