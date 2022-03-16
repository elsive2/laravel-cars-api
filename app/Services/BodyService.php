<?php

namespace App\Services;

use App\Repositories\BodyRepository;

class BodyService
{
	/**
	 * __construct
	 *
	 * @param BodyRepository $bodyRepository
	 * @return void
	 */
	public function __construct(
		private BodyRepository $bodyRepository
	) {
	}

	/**
	 * Get all the bodies
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return $this->bodyRepository->all();
	}

	/**
	 * Get a body by its id
	 *
	 * @param  int $id
	 * @return \App\Models\Body
	 */
	public function getById(int $id)
	{
		$body = $this->bodyRepository->getById($id);

		abort_if(is_null($body), 404);

		return $body;
	}

	/**
	 * Create a body
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return \App\Models\Body
	 */
	public function create($data)
	{
		return $this->bodyRepository->create($data->toArray());
	}

	/**
	 * Update a body by its id
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @param  int $id
	 * @return bool
	 */
	public function update($data, int $id)
	{
		$body = $this->getById($id);

		return $this->bodyRepository->update($data->toArray(), $body);
	}

	/**
	 * Delete a body by its id
	 *
	 * @param  int $id
	 * @return bool|null
	 */
	public function delete(int $id)
	{
		$body = $this->getById($id);

		return $this->bodyRepository->delete($body);
	}
}
