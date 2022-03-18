<?php

namespace App\Models;

use App\Observers\GearBoxObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GearBox extends Model
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

		GearBox::observe(GearBoxObserver::class);
	}
}
