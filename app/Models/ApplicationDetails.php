<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDetails extends Model
{
    use HasFactory;
    public function applicationName()
    {
        return $this->belongsTo(ApplicationName::class,'app_name_id');
    }
}
