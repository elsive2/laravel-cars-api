<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait NameSluggable
{
	/**
	 * Set the slug name 
	 *
	 * @param  string $name
	 * @return void
	 */
	public function setNameAttribute(string $name)
	{
		$this->attributes['name'] = Str::slug($name);
	}
}
