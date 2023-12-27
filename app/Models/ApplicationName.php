<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationName extends Model
{
    protected $fillable = [
        'name',
    ];

    public function applicationDetails()
    {
        return $this->belongsToMany(ApplicationDetails::class, 'application_detail_application_name', 'application_name_id', 'application_detail_id');
    }

}
