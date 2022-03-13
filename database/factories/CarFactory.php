<?php

namespace Database\Factories;

use App\Helpers\CarsConstant;
use App\Models\Country;
use App\Models\Option;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'model' => $this->faker->company,
			'type' => Arr::random(CarsConstant::TYPE),
			'price' => random_int(1000, 100000),
			'year' => random_int(1900, (int)date('Y')),
			'is_active' => random_int(0, 1),
			'is_working' => random_int(0, 1),
			'option_id' => Option::factory(),
			'country_id' => Country::factory(),
			'brand_id' => random_int(1, 3),
		];
	}
}
