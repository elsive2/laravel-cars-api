<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
	public function create(array $data)
	{
		return User::create($data);
	}
}
