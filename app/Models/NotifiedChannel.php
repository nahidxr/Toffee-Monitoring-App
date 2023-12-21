<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifiedChannel extends Model
{
    protected $table = 'notified_channels';

    protected $fillable = [
        'source_provider',
        'service',
        'incident_number',
        'channel',
        'channel_status',
    ];
    public function cname()
    {
        return $this->belongsTo(Cname::class,'channel_name_id');
    }
    public function cprofile()
    {
        return $this->belongsTo(Cprofile::class,'cprofile_id');
    }
}
