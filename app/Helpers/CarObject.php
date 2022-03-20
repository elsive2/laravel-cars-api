<?php

namespace App\Helpers;

class CarObject
{
	public $data;

	/**
	 * __construct
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return void
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}

	/**
	 * Get attrubutes that are suitable to add new options
	 *
	 * @return array
	 */
	public function getOptionsData()
	{
		return $this->data->only([
			'wheel_position',
			'drive_unit',
			'mileage',
			'engine_capacity',
			'body_id',
			'engine_id',
			'gear_box_id',
			'color_id',
		]);
	}

	/**
	 * Get attrubutes that are suitable to add a new car
	 *
	 * @return array
	 */
	public function getCarData()
	{
		return $this->data->only([
			'model',
			'type',
			'price',
			'year',
			'is_active',
			'is_working',
			'option_id',
			'country_id',
			'brand_id',
		]);
	}
}
