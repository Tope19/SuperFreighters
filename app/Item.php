<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded=["id"];

    public function trans_mode(){
        return $this->belongsTo(TransportMode::class);
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }
}
