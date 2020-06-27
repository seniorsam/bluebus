<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
