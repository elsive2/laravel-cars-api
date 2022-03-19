<?php

namespace App\Repositories;

use App\Models\GearBox;

class GearBoxRepository
{
	/**
	 * Get all bodies
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return GearBox::all();
	}

	/**
	 * Get a gear box by its id
	 *
	 * @param  int $id
	 * @return GearBox|null
	 */
	public function getById(int $id)
	{
		return GearBox::find($id);
	}

	/**
	 * Create a new gear box
	 *
	 * @param  array $data
	 * @return GearBox
	 */
	public function create(array $data)
	{
		return GearBox::create($data);
	}

	/**
	 * Update the gear box
	 *
	 * @param  array $data
	 * @param  GearBox $gearBox
	 * @return bool
	 */
	public function update(array $data, GearBox $gearBox)
	{
		return $gearBox->update($data);
	}

	/**
	 * Delete the gear box
	 *
	 * @param  GearBox $gearBox
	 * @return bool|null
	 */
	public function delete(GearBox $gearBox)
	{
		return $gearBox->delete();
	}
}
