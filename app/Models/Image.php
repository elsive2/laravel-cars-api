<?php

namespace App\Models;

use App\Observers\ImageObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<string>
	 */
	protected $fillable = [
		'name',
		'car_id'
	];

	/**
	 * Get the images whice own to the car
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function car()
	{
		return $this->belongsTo(Car::class);
	}

	/**
	 * method "boot"
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();

		Image::observe(ImageObserver::class);
	}
}
