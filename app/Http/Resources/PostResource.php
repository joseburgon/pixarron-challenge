<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'type' => 'posts',
            'id' => (string) $this->resource->id,
            'attributes' => [
                'user_id' => (string) $this->resource->user_id,
                'title' => $this->resource->title,
                'body' => $this->resource->body,
            ]
        ];
    }
}
