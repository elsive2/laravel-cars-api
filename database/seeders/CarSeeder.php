<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Image;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Car::factory(20)->create()->each(function (Car $car) {
			$car->images()->save(Image::factory()->create([
				'car_id' => $car->id
			]));
		});
	}
}
