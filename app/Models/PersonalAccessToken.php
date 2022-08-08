<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as PersonalAccessTokenAlias;

class PersonalAccessToken extends PersonalAccessTokenAlias
{
    use HasFactory;
    protected $fillable = [
        'name',
        'token',
        'abilities',
    ];

    protected $casts = [
        'abilities' => 'json',
        'last_used_at' => 'datetime',
    ];
}
