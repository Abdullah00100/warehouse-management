<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class exportInventoryProductRecource extends JsonResource
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
            'export_id' => $this->export_id,
            'export_bill_number' => $this->export->bill_number,
            'inventory_product_id' => $this->inventory_product_id,
            'inventory_product_product_id' => $this->inventoryProduct->product->id,
            'inventory_product_product_name' => $this->inventoryProduct->product->name,
            'inventory_product_quantity' => $this->inventoryProduct->quantity,
            'export_product_price' => $this->export_product_price,
        ];
    }
}
