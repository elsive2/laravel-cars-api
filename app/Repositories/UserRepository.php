<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
	/**
	 * Create a new user
	 *
	 * @param  array $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create($data);
	}

	/**
	 * Get a user by its email
	 *
	 * @param  string $email
	 * @return User
	 */
	public function getByEmail(string $email)
	{
		return User::whereEmail($email)->first();
	}
}
