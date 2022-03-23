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

	public function register(RegisterRequest $request)
	{
		return $this->result($this->authService->register($request->safe()));
	}

	public function login(LoginRequest $request)
	{
		return $this->reusltToken($this->authService->login($request->safe()));
	}
}
