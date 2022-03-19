<?php

namespace App\Repositories;

use App\Models\Color;

class ColorRepository
{
	/**
	 * Get all the colors
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return Color::all();
	}

	/**
	 * Get a color by its id
	 *
	 * @param  int $id
	 * @return Color|null
	 */
	public function getById(int $id)
	{
		return Color::find($id);
	}

	/**
	 * Create a new color
	 *
	 * @param  array $data
	 * @return Color
	 */
	public function create(array $data)
	{
		return Color::create($data);
	}

	/**
	 * Update the color
	 *
	 * @param  array $data
	 * @param  Color $color
	 * @return bool
	 */
	public function update(array $data, Color $color)
	{
		return $color->update($data);
	}

	/**
	 * Delete the color
	 *
	 * @param  Color $color
	 * @return bool|null
	 */
	public function delete(Color $color)
	{
		return $color->delete();
	}
}
