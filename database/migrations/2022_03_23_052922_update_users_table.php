<?php

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
		Schema::table('users', function (Blueprint $table) {
			$table->after('password', function () use ($table) {
				$table->boolean('locked')->default(0);
				$table->boolean('is_admin')->default(0);
			});
			$table->dropRememberToken();
			$table->dropColumn('email_verified_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('locked');
			$table->dropColumn('is_admin');
			$table->rememberToken();
			$table->timestamp('email_verified_at')->nullable();
		});
	}
};
