<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinePart extends Model
{
    protected $table = 'line_parts';
    public $timestamps = false;
    protected $fillable = [
        'line_id',
        'child_line_id',
    ];

    public function line(){
        return $this->belongsTo(Line::class);
    }
}
