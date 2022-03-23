<?php

namespace App\Services;

use App\Repositories\UserRepository;

class AuthService extends BaseService
{
	public function __construct(
		private UserRepository $userRepository
	) {
	}

	public function register($data)
	{
		$user = $this->userRepository->create($data->toArray());

		if (is_null($user)) {
			return $this->errNotFound('User hasn\'t been found!');
		}
		if (!($user instanceof \App\Models\User)) {
			return $this->errValidate('The element isn\'t a user model!');
		}
		return $this->successMessage('User has been registered!');
	}
}
