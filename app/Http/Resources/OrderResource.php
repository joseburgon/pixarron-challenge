<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'orders',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'user_id' => $this->resource->user_id,
                'user_address_id' => $this->resource->user_address_id,
                'payment_gateway' => $this->resource->payment_gateway,
                'shipped' => $this->resource->shipped,
                'error' => (boolean) $this->resource->error,
                'created_at' => $this->resource->created_at,
                'updated_at' => $this->resource->updated_at,
            ],
            'relationships' => [
                'user' => UserResource::make($this->whenLoaded('user'))
            ],
            'links' => [
                'self' => route('api.v1.orders.show', $this->resource)
            ]
        ];
    }
}
