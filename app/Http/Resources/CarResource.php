<?php

namespace App\Http\Resources;

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
			'is_working' => $this->is_working,
			'country' => $this->country->name,
			'brand' => $this->brand->name,
			'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
			'images' => ImageResource::collection($this->images)
		];
	}
}
