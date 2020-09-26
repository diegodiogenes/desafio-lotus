<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'code' => $this->code,
            'price' => $this->price_formatted,
            'sale_price' => $this->sale_price_formatted,
            'available' => $this->available
        ];
    }
}
