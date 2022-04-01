<?php

namespace App\Http\Resources\WpProducts;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
        'id' => $this->ID,
        'title' => $this->post_title,
        'product_image' => new ProductGalleryResource($this->product_image),
        'content' => $this->post_content,
        'features' => $this->post_excerpt,
        'product_attributes' => $this->product_attributes,
        'product_galleries' => ProductGalleryResource::collection($this->product_galleries)

      ];
    }
}
