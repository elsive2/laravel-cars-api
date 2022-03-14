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
			'is_working' 		=> ['required'],
			'mileage'			=> ['required', 'integer', 'min:0'],
			'drive_unit'		=> ['required', Rule::in(CarsConstant::DRIVE_UNIT)],
			'wheel_position'	=> ['required', Rule::in(CarsConstant::WHEEL_POSITION)],
			'country' 			=> ['required', 'exists:countries,name'],
			'brand' 			=> ['required', 'string', 'exists:brands,name'],
			'engine_capacity' 	=> ['required', 'digits_between:1,50'],
			'body' 				=> ['required', 'string', 'exists:bodies,name'],
			'engine' 			=> ['required', 'string', 'exists:engines,name'],
			'gear_box'			=> ['required', 'string', 'exists:gear_boxes,name'],
			'color' 			=> ['required', 'exists:colors,name'],
			'metalic' 			=> ['required'],
		];
	}
}
