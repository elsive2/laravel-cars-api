<?php

namespace App\Http\Requests;

use App\Helpers\CarsConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarStoreRequest extends FormRequest
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
			'model' 			=> ['required', 'string', 'max:255'],
			'type' 				=> ['required', Rule::in(CarsConstant::TYPE)],
			'price' 			=> ['required', 'integer', 'min:1'],
			'year' 				=> ['required', 'integer', 'between:1855,' . date('Y')],
			'is_working' 		=> ['required', 'boolean'],
			'mileage'			=> ['required', 'integer', 'min:0'],
			'drive_unit'		=> ['required', Rule::in(CarsConstant::DRIVE_UNIT)],
			'wheel_position'	=> ['required', Rule::in(CarsConstant::WHEEL_POSITION)],
			'engine_capacity' 	=> ['required', 'integer', 'between:1,50'],
			'country_id' 		=> ['required', 'exists:countries,id'],
			'brand_id' 			=> ['required', 'exists:brands,id'],
			'body_id' 			=> ['required', 'exists:bodies,id'],
			'engine_id' 		=> ['required', 'exists:engines,id'],
			'gear_box_id'		=> ['required', 'exists:gear_boxes,id'],
			'color_id' 			=> ['required', 'exists:colors,id'],
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
