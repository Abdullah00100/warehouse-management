<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class importProduct extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','import_id','quantity'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    public function import(){
        return $this->belongsTo(Import::class);
    }

}
