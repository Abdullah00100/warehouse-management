<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{

    use HasFactory;

    public $fillable = ['name','mobile_number','address','country','city','dealer_type'];

    public function import(){
        return $this->hasMany(Import::class);
    }

    public function exports(){
        return $this->hasMany(export::class);
    }

}
