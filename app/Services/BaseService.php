<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

abstract class BaseService
{
	/**
	 * @param  string|null $message
	 * @return ResultService
	 */
	protected function errValidate($message = null)
	{
		Log::error(__('api.base.validate'));
		return $this->message(422, $message ?? __('api.base.validate'));
	}

	/**
	 * @param  string|null $message
	 * @return ResultService
	 */
	protected function errForbidden($message = null)
	{
		Log::error(__('api.base.forbidden'));
		return $this->message(403, $message ?? __('api.base.forbidden'));
	}

	/**
	 * @param  string|null $message
	 * @return ResultService
	 */
	protected function errNotFound($message = null)
	{
		Log::error(__('api.base.not_found'));
		return $this->message(404, $message ?? __('api.base.not_found'));
	}

	/**
	 * @param  string|null $message
	 * @return ResultService
	 */
	protected function errService($message = null)
	{
		Log::error(__('api.smth_wrong'));
		return $this->message(500, $message ?? __('api.smth_wrong'));
	}

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function successMessage(string $message)
	{
		Log::info($message);
		return $this->message(200, $message);
	}

	/**
	 * @param  mixed $data
	 * @return ResultService
	 */
	protected function successData($data)
	{
		Log::info(__('api.base.sent'));
		return new ResultService([
			'data' => $data,
			'code' => 200,
		]);
	}

	/**
	 * @param  int $code
	 * @param  string $message
	 * @return ResultService
	 */
	private function message(int $code, string $message)
	{
		return new ResultService([
			'data' => [
				'message' => $message
			],
			'code' => $code
		]);
	}
}
