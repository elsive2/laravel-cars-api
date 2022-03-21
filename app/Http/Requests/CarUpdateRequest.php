<?php

namespace App\Http\Requests;

use App\Helpers\CarsConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarUpdateRequest extends FormRequest
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
			'model' 			=> ['nullable', 'string', 'max:255'],
			'type' 				=> ['nullable', Rule::in(CarsConstant::TYPE)],
			'price' 			=> ['nullable', 'integer'],
			'year' 				=> ['nullable', 'digits_between:1885,' . date('Y')],
			'is_working' 		=> ['nullable', 'boolean'],
			'mileage'			=> ['nullable', 'integer', 'min:0'],
			'drive_unit'		=> ['nullable', Rule::in(CarsConstant::DRIVE_UNIT)],
			'wheel_position'	=> ['nullable', Rule::in(CarsConstant::WHEEL_POSITION)],
			'engine_capacity' 	=> ['nullable', 'digits_between:1,50'],
			'country_id' 		=> ['nullable', 'exists:countries,id'],
			'brand_id' 			=> ['nullable', 'string', 'exists:brands,id'],
			'body_id' 			=> ['nullable', 'string', 'exists:bodies,id'],
			'engine_id' 		=> ['nullable', 'string', 'exists:engines,id'],
			'gear_box_id'		=> ['nullable', 'string', 'exists:gear_boxes,id'],
			'color_id' 			=> ['nullable', 'exists:colors,id'],
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
		]);
	}
}
