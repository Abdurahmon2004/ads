<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $image = asset("/storage/ads").'/'.$this->image;
        return [
            "id"=> $this->id,
            'title'=> $this->title,
            'description'=> $this->description,
            'region'=> RegionResource::make($this->region),
            'category'=> CategoryResource::make($this->category),
            'price'=> $this->price,
            'image'=> $image,
            'tags'=> TagResource::collection($this->tags)
        ];
    }
}
