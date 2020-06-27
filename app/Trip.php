<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function seats(){
        return $this->hasMany(Seat::class);
    }
    
    public function bookings(){
        return $this->hasMany(Booking::class);
    }

}
