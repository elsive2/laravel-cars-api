<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	use HasFactory;

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

	public function car()
	{
		return $this->hasOne(Car::class);
	}

	public function body()
	{
		return $this->belongsTo(Body::class);
	}

	public function engine()
	{
		return $this->belongsTo(Engine::class);
	}

	public function gearBox()
	{
		return $this->belongsTo(GearBox::class);
	}

	public function color()
	{
		return $this->belongsTo(Color::class);
	}
}
