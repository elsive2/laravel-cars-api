<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<string>
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * Get the cars which own to the brand
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cars()
	{
		return $this->hasMany(Car::class);
	}

	/**
	 * method "boot"
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();

		static::deleting(function (Brand $brand) {
			$brand->cars()->update([
				'brand_id' => null
			]);
		});
	}
}
