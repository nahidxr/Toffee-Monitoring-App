<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'device_id',
        'status',
        'hostname',
        'os',
        'last_rebooted',
        'location',
        'type',
    ];

    protected $casts = [
        'last_rebooted' => 'datetime', // Casts last_rebooted field to a datetime object
    ];
}
