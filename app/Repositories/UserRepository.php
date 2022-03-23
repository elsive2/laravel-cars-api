<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
	public function create(array $data)
	{
		return User::create($data);
	}

	public function getByEmail(string $email)
	{
		return User::whereEmail($email)->first();
	}
}
