<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GearBox extends Model
{
	use HasFactory;

	protected $fillable = [
		'name'
	];

	public function option()
	{
		return $this->hasMany(Option::class);
	}
}
