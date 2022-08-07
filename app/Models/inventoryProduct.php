<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class inventoryProduct extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','quantity'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function exportInventoryProduct(){
        return $this->hasMany(ExportInventoryProduct::class);
    }

}
