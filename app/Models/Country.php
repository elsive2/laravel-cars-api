<?php

namespace App\Models;

use App\Observers\CountryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
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
	 * Get the cars which own to the country
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

		Country::observe(CountryObserver::class);
	}
}
