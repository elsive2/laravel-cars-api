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
			'model' 			=> ['nullable', 'string'],
			'type' 				=> ['nullable', Rule::in(CarsConstant::TYPE)],
			'price[from]' 		=> ['nullable', 'integer', 'different:price[to]'],
			'price[to]' 		=> ['nullable', 'integer', 'different:price[from]'],
			'year[from]'		=> ['nullable', 'digits_between:1885,' . date('Y')],
			'year[to]' 			=> ['nullable', 'digits_between:1885,' . date('Y')],
			'is_working' 		=> ['nullable', 'boolean'],
			'wheel_position' 	=> ['nullable', Rule::in(CarsConstant::WHEEL_POSITION)],
			'drive_unit' 		=> ['nullable', Rule::in(CarsConstant::DRIVE_UNIT)],
			'mileage' 			=> ['nullable', 'integer', 'min:0'],
			'engine_capacity' 	=> ['nullable', 'digits_between:1,50'],
			'body' 				=> ['nullable', 'exists:bodies,name'],
			'engine' 			=> ['nullable', 'exists:engines,name'],
			'gear_box' 			=> ['nullable', 'exists:gear_boxes,name'],
			'color' 			=> ['nullable', 'exists:colors,name'],
			'color_metalic' 	=> ['nullable', 'boolean'],
			'country' 			=> ['nullable', 'exists:countries,name'],
			'brand' 			=> ['nullable', 'exists:brands,name'],
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
