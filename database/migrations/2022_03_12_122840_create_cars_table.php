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
		Schema::create('cars', function (Blueprint $table) {
			$table->id();
			$table->string('model')->index();
			$table->enum('type', CarsConstant::TYPE)->index();
			$table->unsignedBigInteger('price')->index();
			$table->unsignedInteger('year')->index();
			$table->boolean('is_active')->default(false);
			$table->boolean('is_working')->default(true);
			$table->foreignId('options_id')->index()->constrained('options');
			$table->foreignId('country_id')->index()->constrained('countries');
			$table->foreignId('brand_id')->index()->constrained('brands');
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
		Schema::dropIfExists('cars');
	}
};
