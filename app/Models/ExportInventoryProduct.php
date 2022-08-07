<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportInventoryProduct extends Model
{
    use HasFactory;

    protected $fillable = ['export_id','quantity','inventory_product_id','export_product_price'];

    
}
