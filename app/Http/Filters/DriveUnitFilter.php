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
	 * @param  mixed $value
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder, $value)
	{
		return $builder->whereRelation('options', function ($subQuery) use ($value) {
			$subQuery->whereIn('drive_unit', $value);
		});
	}
}
