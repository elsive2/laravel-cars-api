<?php

namespace Database\Factories;

use App\Helpers\CarsConstant;
use App\Models\Color;
use App\Models\Engine;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'wheel_position' => Arr::random(CarsConstant::WHEEL_POSITION),
			'drive_unit' => Arr::random(CarsConstant::DRIVE_UNIT),
			'mileage' => random_int(10000, 100000),
			'engine_capacity' => random_int(1, 5),
			'body_id' => random_int(1, 3),
			'engine_id' => Engine::factory(),
			'gear_box_id' => random_int(1, 2),
			'color_id' => Color::factory(),
		];
	}
}
