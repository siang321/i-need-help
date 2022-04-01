<?php

namespace App\Http\Resources\WpProducts;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
          'id' => $this->term_taxonomy_id,
          'name' => $this->term->name,
          'description' => $this->description,
          'image_path' => "https://seahawkfishing.com/wp-content/uploads/2020/06/g_banner_lures_lo.jpg",
          'sub_categories' => CategoryResource::collection($this->children_terms)
        ];
    }
}
