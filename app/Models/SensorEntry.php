<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorEntry extends Model
{
    protected $fillable = [
        'sensor_id',
        'value',
        'type'
    ];
}
