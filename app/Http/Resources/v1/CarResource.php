<?php

namespace App\Http\Resources\v1;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'model' => $this->model,
			'type' => $this->type,
			'price' => $this->price,
			'year' => $this->year,
			'is_working' => (bool)$this->is_working,
			'is_active' => (bool)$this->is_active,
			'country' => $this->country->name,
			'brand' => $this->brand->name,
			'wheel_position' => $this->options->wheel_position,
			'drive_unit' => $this->options->drive_unit,
			'mileage' => $this->options->mileage,
			'engine_capactiy' => $this->options->engine_capacity,
			'body' => $this->options->body->name,
			'engine' => $this->options->engine->name,
			'gear_box' => $this->options->gearBox->name,
			'color' => new ColorResource($this->options->color),
			'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
			'images' => ImageResource::collection($this->images)
		];
	}
}
