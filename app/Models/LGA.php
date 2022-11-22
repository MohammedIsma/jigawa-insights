<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
    use HasFactory;

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function pollingUnit()
    {
        return $this->hasMany(PollingUnit::class);
    }
    public function ward()
    {
        return $this->hasMany(Ward::class);
    }
}
