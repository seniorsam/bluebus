<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{

    protected $fillable = [
        'id',
        'from_id',
        'to_id',
        'trip_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function trip(){
        return $this->belongsTo(Trip::class);
    }

    public function stationFrom (){
        return $this->belongsTo(Station::class, 'from_id');
    }

    public function stationTo (){
        return $this->belongsTo(Station::class, 'to_id');
    }

    public function bookings (){
        return $this->hasMany(Booking::class);
    }
    
    public function parts(){
        return $this->hasMany(LinePart::class);
    }
}
