<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
	/**
	 * __construct
	 * 
	 * @param AuthService $authService
	 * @return void
	 */
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
		return $this->result($this->authService->register($request->safe()));
	}

	/**
	 * Login the user
	 *
	 * @param  LoginRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(LoginRequest $request)
	{
		return $this->reusltToken($this->authService->login($request->safe()));
	}

	/**
	 * Logout the user
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		return $this->result($this->authService->logout());
	}
}
