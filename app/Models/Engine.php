<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
	use HasFactory;

	protected $fillable = [
		'name'
	];

	public function options()
	{
		return $this->hasMany(Option::class);
	}
}
