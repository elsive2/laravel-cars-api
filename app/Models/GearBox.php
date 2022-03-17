<?php

namespace App\Models;

use App\Traits\NameSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GearBox extends Model
{
	use HasFactory, NameSluggable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<string>
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * Get the options which own to the gear box
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function options()
	{
		return $this->hasMany(Option::class);
	}

	/**
	 * Get the cars which own to the gear box
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function cars()
	{
		return $this->hasManyThrough(Car::class, Option::class);
	}

	/**
	 * method "boot"
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();

		static::deleting(function (GearBox $gearBox) {
			$gearBox->options()->update([
				'gear_box_id' => null
			]);
		});
	}
}
