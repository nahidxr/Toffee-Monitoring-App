<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cprofile extends Model
{
    use HasFactory;
    public function cname()
    {
        return $this->belongsTo(Cname::class,'channel_name_id');
    }
}
