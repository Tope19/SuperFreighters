<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['country_id', 'name' , 'flat_rate'];

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
