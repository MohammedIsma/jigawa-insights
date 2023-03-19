<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $guarded = [];

    public function PollingUnit(){
        return $this->belongsTo(PollingUnit::class);
    }
}
