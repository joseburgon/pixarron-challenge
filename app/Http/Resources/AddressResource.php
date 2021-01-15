<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'addresses',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'user_id' => $this->resource->user_id,
                'street' => $this->resource->street,
                'city' => $this->resource->city,
                'state' => $this->resource->state,
                'country' => $this->resource->country,
                'zip_code' => $this->resource->zip_code,
            ],
            'relationships' => [
                'user' => UserResource::make($this->whenLoaded('user'))
            ],
            'links' => [
                'self' => route('api.v1.addresses.show', $this->resource)
            ]
        ];
    }
}
