<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
    protected $table = 'lgas';
    //protected $foreigKkey = 'lga_id';
    use HasFactory;

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function pollingUnit()
    {
        return $this->hasMany(PollingUnit::class, 'lga_id', 'id');
    }
    public function ward()
    {
        return $this->hasMany(Ward::class, 'lga_id', 'id');
    }
}
