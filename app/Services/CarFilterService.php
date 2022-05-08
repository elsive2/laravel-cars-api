<?php

namespace App\Services;

class CarFilterService extends FilterService
{
	/**
	 * Get all the car filters
	 *
	 * @return array<\App\Http\Filters\QueryFilter>
	 */
	public static function filters()
	{
		return [
			\App\Http\Filters\ModelFilter::class,
			\App\Http\Filters\TypeFilter::class,
			\App\Http\Filters\PriceFromFilter::class,
			\App\Http\Filters\PriceToFilter::class,
			\App\Http\Filters\YearFromFilter::class,
			\App\Http\Filters\YearToFilter::class,
			\App\Http\Filters\IsWorkingFilter::class,
			\App\Http\Filters\DriveUnitFilter::class,
			\App\Http\Filters\WheelPositionFilter::class,
			\App\Http\Filters\MileageFromFilter::class,
			\App\Http\Filters\MileageToFilter::class,
			\App\Http\Filters\EngineCapacityToFilter::class,
			\App\Http\Filters\EngineCapacityFromFilter::class,
			\App\Http\Filters\BodyFilter::class,
			\App\Http\Filters\EngineFilter::class,
			\App\Http\Filters\GearBoxFilter::class,
			\App\Http\Filters\ColorFIlter::class,
			\App\Http\Filters\ColorMetalicFilter::class,
			\App\Http\Filters\CountryFilter::class,
			\App\Http\Filters\BrandFilter::class,
		];
	}
}
