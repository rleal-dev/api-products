<?php

namespace App\Api\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'dimensions' => $this->dimensions,
            'code' => $this->code,
            'reference' => $this->reference,
            'quantity_stock' => $this->quantity_stock,
            'price' => $this->price,
            'is_active' => (bool) $this->is_active,
            'created_at' => $this->created_at,
        ];
    }
}
