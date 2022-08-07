<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = ['dealer_id','bill_number','shipping_charge_price','total_price'];

    public function dealer(){
        return $this->belongsTo(dealer::class);
    }

    public function importproduct(){
        return $this->hasMany(Importproduct::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class,'import_products','import_id','product_id');
    }

    
}
