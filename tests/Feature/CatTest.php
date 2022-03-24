<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Image;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CatTest extends TestCase
{
	public function testGetAllCars()
	{
		$response = $this->get(route('cars.index'));

		$response->assertStatus(200)
			->assertJson(function (AssertableJson $json) {
				$json->hasAll(['meta', 'links', 'data']);
			});
	}

	public function testShowACar()
	{
		$response = $this->getJson(route('cars.show', 1));

		$response->assertStatus(200)
			->assertJson(
				function (AssertableJson $json) {
					$json->hasAll([
						'data',
						'data.id',
						'data.type',
						'data.price',
						'data.year',
						'data.is_working',
						'data.is_active',
						'data.country',
						'data.brand',
						'data.wheel_position',
						'data.drive_unit',
						'data.mileage',
						'data.body',
						'data.engine',
						'data.gear_box',
						'data.color.name',
						'data.color.metalic',
						'data.created_at',
						'data.images',
						'data.engine_capactiy',
					]);
				}
			);
	}

	public function testShowErrorNotFound()
	{
		$response = $this->getJson(route('cars.show', 999));

		$response->assertNotFound()
			->assertJson(function (AssertableJson $json) {
				$json->has('message');
			});
	}

	public function testCreateANewCar()
	{
		$this->actingAs(User::first());

		$car = Car::factory()->make();

		$image = new Image;
		$image->name = 'fake.jpg';
		$image->save();

		$response = $this->postJson(route('cars.store'), [
			'model' => $car->model,
			'type' => $car->type,
			'price' => $car->price,
			'year' => $car->year,
			'is_working' => $car->is_working,
			'mileage' => $car->options->mileage,
			'drive_unit' => $car->options->drive_unit,
			'wheel_position' => $car->options->wheel_position,
			'country_id' => $car->country_id,
			'brand_id' => $car->brand_id,
			'engine_capacity' => $car->options->engine_capacity,
			'body_id' => $car->options->body_id,
			'engine_id' => $car->options->engine_id,
			'gear_box_id' => $car->options->gear_box_id,
			'color_id' => $car->options->color_id,
			'metalic' => $car->options->color->metalic,
			'images_id' => $image->id
		]);

		$response->assertStatus(200)
			->assertJson(function (AssertableJson $json) {
				$json->has('message');
			});
	}

	public function testUpdateTheCar()
	{
		$this->actingAs(User::first());

		$car = Car::factory()->make();

		$response = $this->putJson(route('cars.update', Car::first()->id), [
			'model' => $car->model,
			'brand_id' => $car->brand_id,
			'engine_id' => $car->options->engine_id,
		]);

		$response->assertStatus(200)
			->assertJson(function (AssertableJson $json) {
				$json->has('message');
			});
	}

	public function testDeleteTheCar()
	{
		$this->actingAs(User::first());

		$car = Car::factory()->create();

		$response = $this->deleteJson(route('cars.destroy', $car->id));

		$response->assertStatus(200)
			->assertJson(function (AssertableJson $json) {
				return $json->has('message');
			});
	}
}
