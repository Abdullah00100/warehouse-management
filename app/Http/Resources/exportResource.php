<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class exportResource extends JsonResource
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
            'dealer_id' => $this->dealer->id,
            'dealer_name' => $this->dealer->name,
            'bill_number' => $this->bill_number,
            'shipping_charge_price' => $this->shipping_charge_price,
            'has_received' => $this->has_received,
            'total_price' => $this->total_price,
            'export_inventory_products' => $this->when('exportInventoryProduct', exportInventoryProductRecource::collection($this->exportInventoryProduct))
            // 'inventory_products' =>collect($this->inventory_products)->map(function($a){
            //     return $a->with('exportInventoryProduct')->get();
            // }),
            // 'quantity'=>collect($this->exportInventoryProduct)->map(function($a){
            //              return $a->quantity;
            //          }),
        ];
    }
}
