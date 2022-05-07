<?php

namespace App\Http\Filters;

class WheelPositionFilter implements QueryFilter
{
	/**
	 * Set a filter name
	 *
	 * @return void
	 */
	public function getFilterName()
	{
		return 'wheel_position';
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
		return $builder->whereRelation('options', 'wheel_position', $value);
	}
}
