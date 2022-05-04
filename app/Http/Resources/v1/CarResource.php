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
			'isWorking' => (bool)$this->is_working,
			'isActive' => (bool)$this->is_active,
			'country' => $this->country->name,
			'brand' => $this->brand->name,
			'wheelPosition' => $this->options->wheel_position,
			'drive_unit' => $this->options->drive_unit,
			'mileage' => $this->options->mileage,
			'engineCapactiy' => $this->options->engine_capacity,
			'body' => $this->options->body->name,
			'engine' => $this->options->engine->name,
			'gearBox' => $this->options->gearBox->name,
			'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d'),
			'color' => new ColorResource($this->options->color),
			'owner' => new OwnerResource($this->user),
			'images' => ImageResource::collection($this->images)
		];
	}
}
