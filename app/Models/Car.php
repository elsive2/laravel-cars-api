<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<string>
	 */
	protected $fillable = [
		'model',
		'type',
		'price',
		'year',
		'is_active',
		'is_working',
		'option_id',
		'country_id',
		'brand_id'
	];

	/**
	 * Get the options which own to the car
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function options()
	{
		return $this->belongsTo(Option::class, 'option_id');
	}

	/**
	 * Get the country which owns to the car
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	/**
	 * Get the brand which owns to the car
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	/**
	 * Get the images which own to the car
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function images()
	{
		return $this->hasMany(Image::class);
	}
}
