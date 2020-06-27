<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'userip',
        'seat_id',
        'line_id',
        'trip_id',
    ];

    function seat(){
        return $this->belongsTo(Seat::class);
    }

    public function line(){
        return $this->belongsTo(Line::class);
    }

    public function trip(){
        return $this->belongsTo(Trip::class);
    }

}
