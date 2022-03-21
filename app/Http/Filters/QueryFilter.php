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
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder);
}
