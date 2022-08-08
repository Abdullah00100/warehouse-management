<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImportProductResource extends JsonResource
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
            'pruducts_id' => $this->product->id,
            'pruducts_name' => $this->product->name,
            'import_id' => $this->import->id,
            'import_bill_number' => $this->import->bill_number,
            'quantity' => $this->quantity
        ];
    }
}
