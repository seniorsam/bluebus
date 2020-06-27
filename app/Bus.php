<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    public function seats (){
        return $this->hasMany(Seat::class);
    }

}
