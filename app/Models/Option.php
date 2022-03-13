<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<string>
	 */
	protected $fillable = [
		'wheel_position',
		'drive_unit',
		'mileage',
		'engine_capacity',
		'body_id',
		'engine_id',
		'gear_box_id',
		'color_id',
	];

	/**
	 * Get the car which owns to the options
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function car()
	{
		return $this->hasOne(Car::class);
	}

	/**
	 * Get the body which owns to the options
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function body()
	{
		return $this->belongsTo(Body::class);
	}

	/**
	 * Get the engine which owns to the options
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function engine()
	{
		return $this->belongsTo(Engine::class);
	}

	/**
	 * Get the gear box which owns to the options
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function gearBox()
	{
		return $this->belongsTo(GearBox::class);
	}

	/**
	 * Get the color which owns to the options
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function color()
	{
		return $this->belongsTo(Color::class);
	}
}
