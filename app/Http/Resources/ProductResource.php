<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'brand' => $this->brand,
            'category' => new CategoryResource($this->category),
            'weight_or_volume' => $this->weight_or_volume,
            'country_of_manufacture' => $this->country_of_manufacture,
            'stock' => $this->stock,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'discounted_price' => $this->discounted_price,
            'discount_percentage' => $this->discount_percentage,
            'rating' => $this->averageRating()
        ];
    }
}
