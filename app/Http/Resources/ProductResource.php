<?php

namespace App\Http\Resources;

use App\Models\Photo;
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
//        return parent::toArray($request);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "brand_name" => $this->brand->name,
            "user_id" => $this->user_id,
            "actual_price" => $this->actual_price,
            "sales_price" => $this->sales_price,
            "total_stock" => $this->total_stock,
            "unit" => $this->unit,
            "more_information" => $this->more_information,
            "photos" => Photo::find(1)->url,
            "updated_at" => $this->updated_at->format('d m Y'),
            "created_at" => $this->created_at->format('d m Y')
        ];
    }
}
