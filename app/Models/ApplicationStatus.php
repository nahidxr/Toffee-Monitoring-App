<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    protected $fillable = [
        'app_detail_id',
        'reported_date',
        'reported_time',
        'type',
        'status',
        // Other fields as needed
    ];

    public function applicationDetail()
    {
        return $this->belongsTo(ApplicationDetail::class, 'app_detail_id');
    }
}
