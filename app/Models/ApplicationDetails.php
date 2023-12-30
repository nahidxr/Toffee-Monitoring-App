<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDetails extends Model
{
    protected $fillable = [
        'node_name', 'ip', 'location', 'connection_type', 'owner', 'status'
    ];

    public function applicationNames()
    {
        return $this->belongsToMany(ApplicationName::class, 'application_detail_application_name', 'application_detail_id', 'application_name_id');
    }
    public function applicationStatuses()
    {
        return $this->hasMany(ApplicationStatus::class, 'app_detail_id');
    }
}
