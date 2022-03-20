<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

abstract class BaseService
{
	private const MESSAGES = [
		403 => 'Forbidden error!',
		404 => 'Not found!',
		422 => 'Validate error has occured!',
		500 => 'Something went wrong!',
	];

	/**
	 * @param  string|null $message
	 * @return ResultService
	 */
	protected function errValidate($message = null)
	{
		Log::error(self::MESSAGES[422]);

		return $this->message(422, $message ?? self::MESSAGES[422]);
	}

	/**
	 * @param  string|null $message
	 * @return ResultService
	 */
	protected function errForbidden($message = null)
	{
		Log::error(self::MESSAGES[403]);

		return $this->message(403, $message ?? self::MESSAGES[403]);
	}

	/**
	 * @param  string|null $message
	 * @return ResultService
	 */
	protected function errNotFound($message = null)
	{
		Log::error(self::MESSAGES[404]);

		return $this->message(404, $message ?? self::MESSAGES[404]);
	}

	/**
	 * @param  string|null $message
	 * @return ResultService
	 */
	protected function errService($message = null)
	{
		Log::error(self::MESSAGES[500]);

		return $this->message(500, $message ?? self::MESSAGES[500]);
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
	protected function successData(mixed $data)
	{
		Log::info('Data has been sent successfully!');

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
			'data' => ['message' => $message],
			'code' => $code
		]);
	}
}
