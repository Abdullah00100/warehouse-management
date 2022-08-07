<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['department_id','name','image_path','product_code','purchasing_price','seling_price','note'];

    public function department(){
        return  $this->belongsTo(Department::class);
    }

    public function inventoryProduct(){
        return  $this->hasOne(InventoryProduct::class);
    }
}
