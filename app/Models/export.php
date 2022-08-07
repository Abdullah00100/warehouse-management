<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class export extends Model
{
    use HasFactory;

    public $fillable = ['bill_number','shipping_charge_price','dealer_id','has_received','total_price'];

    public function dealer(){
        return $this->belongsTo(dealer::class);
    }

    public function inventaryProducts(){
        return $this->belongsToMany(inventoryProduct::class,'export_inventory_products','export_id','inventory_product_id');
    }
    public function exportInventoryProduct(){
        return $this->hasMany(ExportInventoryProduct::class);
    }
    
}
