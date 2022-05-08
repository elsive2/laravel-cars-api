<?php

namespace App\Http\Requests;

use App\Helpers\CarsConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarFilterRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'model'					=> ['nullable', 'array'],
			'model.*' 				=> ['nullable', 'string'],
			'type' 					=> ['nullable', Rule::in(CarsConstant::TYPE)],
			'price.from' 			=> ['nullable', 'integer', 'different:price.to'],
			'price.to' 				=> ['nullable', 'integer', 'different:price.from'],
			'year.from'				=> ['nullable', 'integer', 'between:1885,' . date('Y')],
			'year.to' 				=> ['nullable', 'integer', 'between:1885,' . date('Y')],
			'is_working' 			=> ['nullable', 'boolean'],
			'wheel_position' 		=> ['nullable', Rule::in(CarsConstant::WHEEL_POSITION)],
			'drive_unit' 			=> ['nullable', 'array', Rule::in(CarsConstant::DRIVE_UNIT)],
			'mileage.from'			=> ['nullable', 'integer', 'min:0', 'different:mileage.to'],
			'mileage.to'			=> ['nullable', 'integer', 'min:0', 'different:mileage.from'],
			'engine_capacity.from'	=> ['nullable', 'integer', 'min:1', 'different:engine_capacity.to'],
			'engine_capacity.to'	=> ['nullable', 'integer', 'max:50', 'different:engine_capacity.from'],
			'body' 					=> ['nullable', 'array', 'exists:bodies,name'],
			'engine' 				=> ['nullable', 'array', 'exists:engines,name'],
			'gear_box' 				=> ['nullable', 'array', 'exists:gear_boxes,name'],
			'color' 				=> ['nullable', 'array', 'exists:colors,name'],
			'color_metalic' 		=> ['nullable', 'boolean'],
			'country' 				=> ['nullable', 'array', 'exists:countries,name'],
			'brand' 				=> ['nullable', 'array', 'exists:brands,name'],
			'order'					=> ['nullable', 'in:asc,desc'],
			'sort'					=> ['nullable', 'in:model,price,year'],
			'per_page'				=> ['nullable', 'integer', 'min:1'],
		];
	}

	/**
	 * Prepare for validation
	 *
	 * @return $this
	 */
	protected function prepareForValidation()
	{
		$merged = [];

		if (request('is_working')) {
			$merged['is_working'] = $this->boolean('is_working');
		}
		if (request('metalic')) {
			$merged['metalic'] = $this->boolean('metalic');
		}

		$this->merge($merged);
	}
}
