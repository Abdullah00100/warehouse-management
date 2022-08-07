<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DealerResource extends JsonResource
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
            'mobile_number'=> $this->mobile_number,
            'address'=> $this->address,
            'country'=> $this->country,
            'city'=> $this->city,
            'dealer_type'=> $this->dealer_type,
            'imports'=> $this->import
        ];    
    }
}
