<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreInventoryResource extends JsonResource
{
     /**
     * @var
     */
    private $total;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, $total, $count)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;
        
        $this->totalMoney = $total;
        $this->count = $count;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        return [
            'imports'=> ImportsStoreInventoryResource::collection($this),
            'totalPaid'=> $this->totalMoney,
            'count'=> $this->count
        ];
    }
}
