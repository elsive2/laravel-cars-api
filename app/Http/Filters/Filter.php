<?php

namespace App\Http\Filters;

use Illuminate\Support\Facades\Log;

abstract class Filter
{
	/**
	 * Handle a filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function handle($builder)
	{
		if (request()->has($this->getFilterName())) {
			Log::info($this->getFilterName() . ' - ' . $this->getFilterValue());

			return $this->applyFilter($builder);
		}
		return $builder;
	}

	/**
	 * Apply the filter
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder $builder
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	protected abstract function applyFilter($builder);

	/**
	 * Get a filter name
	 *
	 * @return string
	 */
	protected abstract function getFilterName();


	/**
	 * Get a filter value
	 *
	 * @return mixed
	 */
	protected function getFilterValue()
	{
		return request($this->getFilterName());
	}
}
