<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function LGA(){
        return $this->hasMany(LGA::class, 'lga_id', 'id');
    }

    public function ward()
    {
        return $this->hasMany(Ward::class);
    }

    public function pollingUnit()
    {
        return $this->hasMany(PollingUnit::class);
    }
}
