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
			return $this->errNotFound(__('api.auth.user_not_found'));
		}
		if (!($user instanceof \App\Models\User)) {
			return $this->errValidate(__('api.auth.not_user_model'));
		}
		return $this->successMessage(__('api.auth.registered'));
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
			return $this->errValidate(__('api.auth.wrong'));
		}
		if (!($user instanceof \App\Models\User)) {
			return $this->errValidate(__('api.auth.not_user_model'));
		}

		if (Hash::check($data->password, $user->password)) {
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
		$isDeleted = request()->user()->currentAccessToken()->delete();

		if ($isDeleted) {
			return $this->successMessage(__('api.auth.logged_out'));
		}
		return $this->errService();
	}
}
