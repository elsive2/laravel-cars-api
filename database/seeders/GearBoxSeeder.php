<?php

namespace Database\Seeders;

use App\Models\GearBox;
use Illuminate\Database\Seeder;

class GearBoxSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		GearBox::create(['name' => 'Manual Transmission']);
		GearBox::create(['name' => 'Automatic Transmission']);
	}
}
