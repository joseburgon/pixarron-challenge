<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'users',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'email' => $this->resource->email,
            ],
            'relationships' => [
              'addresses' => AddressResource::collection($this->whenLoaded('addresses')),
              'orders' => OrderResource::collection($this->whenLoaded('orders')),
            ],
            'links' => [
                'self' => route('api.v1.users.show', $this->resource)
            ]
        ];
    }
}
