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
			'model' 				=> ['nullable', 'string'],
			'type' 					=> ['nullable', Rule::in(CarsConstant::TYPE)],
			'price.from' 			=> ['nullable', 'integer', 'different:price.to'],
			'price.to' 				=> ['nullable', 'integer', 'different:price.from'],
			'year.from'				=> ['nullable', 'integer', 'between:1885,' . date('Y')],
			'year.to' 				=> ['nullable', 'integer', 'between:1885,' . date('Y')],
			'is_working' 			=> ['nullable', 'boolean'],
			'wheel_position' 		=> ['nullable', Rule::in(CarsConstant::WHEEL_POSITION)],
			'drive_unit' 			=> ['nullable', Rule::in(CarsConstant::DRIVE_UNIT)],
			'mileage.from'			=> ['nullable', 'integer', 'min:0', 'different:mileage.to'],
			'mileage.to'			=> ['nullable', 'integer', 'min:0', 'different:mileage.from'],
			'engine_capacity' 		=> ['nullable', 'integer', 'between:0,50'],
			'body' 					=> ['nullable', 'exists:bodies,name'],
			'engine' 				=> ['nullable', 'exists:engines,name'],
			'gear_box' 				=> ['nullable', 'exists:gear_boxes,name'],
			'color' 				=> ['nullable', 'exists:colors,name'],
			'color_metalic' 		=> ['nullable', 'boolean'],
			'country' 				=> ['nullable', 'exists:countries,name'],
			'brand' 				=> ['nullable', 'exists:brands,name'],
			'order'					=> ['nullable', 'in:asc,desc'],
			'sort'					=> ['nullable', 'in:model,price,year']
		];
	}

	/**
	 * Prepare for validation
	 *
	 * @return $this
	 */
	protected function prepareForValidation()
	{
		$this->merge([
			'is_working' => $this->boolean('is_working'),
			'metalic' => $this->boolean('metalic'),
		]);
	}
}
