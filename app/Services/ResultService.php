<?php

namespace App\Services;

/**
 * @property int|null code
 * @property mixed|null data
 */
class ResultService
{
	protected $fields = [
		'code' 	=> null,
		'data' 	=> null,
	];

	public function __construct($data = [])
	{
		foreach ($data as $key => $value) {
			$this->fields[$key] = $value;
		}
	}

	/**
	 * @param  string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		return $this->fields[$name];
	}

	/**
	 * @param  mixed $name
	 * @param  mixed $value
	 */
	public function __set($name, $value)
	{
		$this->fields[$name] = $value;
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		return $this->fields;
	}

	/**
	 * @return bool
	 */
	public function isSuccess()
	{
		return $this->fields['code'] == 200;
	}
}
