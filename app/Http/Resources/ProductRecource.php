<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductRecource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'department_name' => $this->department->name,
            'department_id' => $this->department->id,
            'image_path' => asset($this->image_path),
            'product_code' => $this->product_code,
            'purchasing_price' => $this->purchasing_price,
            'seling_price' => $this->seling_price,
            'note' => $this->note,
            // 'inventory' => $this->inventoryProduct,
        ];
    }
}
