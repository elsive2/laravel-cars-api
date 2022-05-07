<?php

namespace App\Http\Filters;

interface QueryFilter
{
	/**
	 * Get filter name
	 *
	 * @return string
	 */
	public function getFilterName();

	/**
	 * Handle a filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @param  mixed $value
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder, $value);
}
