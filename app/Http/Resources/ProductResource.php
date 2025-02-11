<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'product_name' => $this->product_name,
            'image'=> $this->image,
            'product_price'=>$this->product_price,
            'rating'=>$this->rating,
            'food_category'=>$this->food_category,
            'description'=>$this->description
        ];
        //return parent::toArray($request);
    }
}
