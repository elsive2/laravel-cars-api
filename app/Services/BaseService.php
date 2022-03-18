<?php

namespace App\Services;

abstract class BaseService
{
	const DEFAULT_MESSAGES = [
		403 => 'Forbidden error!',
		404 => 'Not found!',
		422 => 'Validate error has occured!',
		500 => 'The service error has occured!',
	];

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function errValidate($message = self::DEFAULT_MESSAGES[422])
	{
		return $this->message(422, $message);
	}

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function errForbidden($message = self::DEFAULT_MESSAGES[403])
	{
		return $this->message(403, $message);
	}

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function errNotFound($message = self::DEFAULT_MESSAGES[404])
	{
		return $this->message(404, $message);
	}

	/**
	 * @param  string $message
	 * @return ResultService
	 */
	protected function errService($message = self::DEFAULT_MESSAGES[500])
	{
		return $this->message(500, $message);
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
	protected function successData(string $data)
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
