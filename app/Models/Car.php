<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'model',
		'type',
		'price',
		'year',
		'is_active',
		'is_working',
		'options_id',
		'country_id',
		'brand_id'
	];

	public function options()
	{
		return $this->belongsTo(Option::class);
	}

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function images()
	{
		return $this->hasMany(Image::class);
	}
}
