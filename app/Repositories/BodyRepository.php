<?php

namespace App\Repositories;

use App\Models\Body;

class BodyRepository
{
	/**
	 * Get all bodies
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return Body::all();
	}

	/**
	 * Get a body by its id
	 *
	 * @param  int $id
	 * @return Body|null
	 */
	public function getById(int $id)
	{
		return Body::find($id);
	}

	/**
	 * Create a new body
	 *
	 * @param  array $data
	 * @return Body
	 */
	public function create(array $data)
	{
		return Body::create($data);
	}

	/**
	 * Update the body
	 *
	 * @param  array $data
	 * @param  Body $body
	 * @return bool
	 */
	public function update(array $data, Body $body)
	{
		return $body->update($data);
	}

	/**
	 * Delete the body
	 *
	 * @param  Body $body
	 * @return bool|null
	 */
	public function delete(Body $body)
	{
		return $body->delete();
	}
}
