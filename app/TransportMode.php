<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportMode extends Model
{
    protected  $fillable=[
        'name',
        'base_fare',
        'price_per_kg'
    ];
}
