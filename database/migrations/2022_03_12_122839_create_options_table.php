<?php

use App\Helpers\CarsConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('options', function (Blueprint $table) {
			$table->id();
			$table->enum('wheel_position', CarsConstant::WHEEL_POSITION);
			$table->enum('drive_unit', CarsConstant::DRIVE_UNIT);
			$table->unsignedBigInteger('mileage');
			$table->unsignedInteger('engine_capacity');
			$table->foreignId('body_id')->index()->nullable()->constrained('bodies');
			$table->foreignId('engine_id')->index()->nullable()->constrained('engines');
			$table->foreignId('gear_box_id')->index()->nullable()->constrained('gear_boxes');
			$table->foreignId('color_id')->index()->nullable()->constrained('colors');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('options');
	}
};
