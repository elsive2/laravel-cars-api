<?php

namespace App\Models;

use App\Observers\EngineObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
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
	 * Get the options whice own to the engine
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function options()
	{
		return $this->hasMany(Option::class);
	}

	/**
	 * Get the cars which own to the engine
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

		Engine::observe(EngineObserver::class);
	}
}
