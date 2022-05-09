<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
	public function __construct(
		private AuthService $authService
	) {
	}

	/**
	 * Register a new user
	 *
	 * @param  RegisterRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function register(RegisterRequest $request)
	{
		$result = $this->authService->register($request->validated());
		return $this->result($result);
	}

	/**
	 * Login the user
	 *
	 * @param  LoginRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(LoginRequest $request)
	{
		$result = $this->authService->login($request->validated());
		return $this->reusltToken($result);
	}

	/**
	 * Logout the user
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		$result = $this->authService->logout();
		return $this->result($result);
	}
}
