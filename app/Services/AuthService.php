<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

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

	public function login($data)
	{
		$user = $this->userRepository->getByEmail($data->email);

		if (is_null($user)) {
			return $this->errValidate('Wrong email or password!');
		}
		if (!($user instanceof \App\Models\User)) {
			return $this->errValidate('The element isn\'t a user model');
		}

		if (Hash::check($data->password, $user->password)) {
			return $this->successData($user->createToken('myAppToken')->plainTextToken);
		}
		return $this->errValidate('Wrong email or password!');
	}
}
