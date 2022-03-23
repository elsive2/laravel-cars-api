<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
	/**
	 * __construct
	 *
	 * @param UserRepository $userRepository
	 * @return void
	 */
	public function __construct(
		private UserRepository $userRepository
	) {
	}

	/**
	 * Register a new user
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return ResultService
	 */
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

	/**
	 * Login the user
	 *
	 * @param  \Illuminate\Support\ValidatedInput $data
	 * @return ResultService
	 */
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

	/**
	 * Logout the user
	 *
	 * @return ResultService
	 */
	public function logout()
	{
		$isDeleted = request()->user()->currentAccessToken()->delete();

		if ($isDeleted) {
			return $this->successMessage('You have been logged out!');
		}
		return $this->errService();
	}
}
