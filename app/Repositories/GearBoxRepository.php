<?php

namespace App\Repositories;

use App\Models\GearBox;

class GearBoxRepository
{
	/**
	 * Get all the bodies
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return GearBox::all();
	}

	/**
	 * Get a body by its id
	 *
	 * @param  int $id
	 * @return GearBox|null
	 */
	public function getById(int $id)
	{
		return GearBox::find($id);
	}

	/**
	 * Create a new body
	 *
	 * @param  array $data
	 * @return GearBox
	 */
	public function create(array $data)
	{
		return GearBox::create($data);
	}

	/**
	 * Update the body
	 *
	 * @param  array $data
	 * @param  GearBox $body
	 * @return bool
	 */
	public function update(array $data, GearBox $body)
	{
		return $body->update($data);
	}

	/**
	 * Delete the body
	 *
	 * @param  GearBox $body
	 * @return bool|null
	 */
	public function delete(GearBox $body)
	{
		return $body->delete();
	}
}
