<?php

namespace Database\Seeders;

use App\Models\Body;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Body::create(['name' => 'sedan']);
		Body::create(['name' => 'coupe']);
		Body::create(['name' => 'cabriolet']);
	}
}
