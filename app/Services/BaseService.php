<?php

namespace App\Services;

abstract class BaseService
{
	const MESSAGES = [
		403 => 'Forbidden error!',
		404 => 'Not found!',
		422 => 'Validate error has occured!',
		500 => 'Something went wrong!',
	];

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function errValidate($message = null)
	{
		return $this->message(422, $message ?? self::MESSAGES[422]);
	}

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function errForbidden($message = null)
	{
		return $this->message(403, $message ?? self::MESSAGES[403]);
	}

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function errNotFound($message = null)
	{
		return $this->message(404, $message ?? self::MESSAGES[404]);
	}

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function errService($message = null)
	{
		return $this->message(500, $message ?? self::MESSAGES[500]);
	}

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function successMessage(string $message)
	{
		return $this->message(200, $message);
	}

	/**
	 * @param  mixed $data
	 * @return ResultService
	 */
	protected function successData($data)
	{
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
	private function message($code, $message)
	{
		return new ResultService([
			'data' => ['message' => $message],
			'code' => $code
		]);
	}
}
