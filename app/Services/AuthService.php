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

	/**
	 * Register a new user
	 *
	 * @param  array $data
	 * @return ResultService
	 */
	public function register(array $data)
	{
		$user = $this->userRepository->create($data);

		if (is_null($user)) {
			return $this->errNotFound(__('api.auth.user_not_found'));
		}
		return $this->successMessage(__('api.auth.registered'));
	}

	/**
	 * Login the user
	 *
	 * @param  array $data
	 * @return ResultService
	 */
	public function login(array $data)
	{
		$user = $this->userRepository->getByEmail($data['email']);

		if (is_null($user)) {
			return $this->errValidate(__('api.auth.wrong'));
		}

		if (Hash::check($data['password'], $user->password)) {
			$token = $user->createToken('myAppToken', [$user->is_admin ? 'admin' : 'guest']);
			return $this->successData($token->plainTextToken);
		}
		return $this->errValidate(__('api.auth.wrong'));
	}

	/**
	 * Logout the user
	 *
	 * @return ResultService
	 */
	public function logout()
	{
		request()->user()->currentAccessToken()->delete();
		return $this->successMessage(__('api.auth.logged_out'));
	}
}
