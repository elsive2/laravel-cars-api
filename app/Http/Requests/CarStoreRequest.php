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
			'price' 			=> ['required', 'integer'],
			'year' 				=> ['required', 'integer'],
			'is_working' 		=> ['required', 'boolean'],
			'mileage'			=> ['required', 'integer', 'min:0'],
			'drive_unit'		=> ['required', Rule::in(CarsConstant::DRIVE_UNIT)],
			'wheel_position'	=> ['required', Rule::in(CarsConstant::WHEEL_POSITION)],
			'engine_capacity' 	=> ['required', 'digits_between:1,50'],
			'country_id' 		=> ['required', 'exists:countries,id'],
			'brand_id' 			=> ['required', 'string', 'exists:brands,id'],
			'body_id' 			=> ['required', 'string', 'exists:bodies,id'],
			'engine_id' 		=> ['required', 'string', 'exists:engines,id'],
			'gear_box_id'		=> ['required', 'string', 'exists:gear_boxes,id'],
			'color_id' 			=> ['required', 'exists:colors,id'],
		];
	}
}
