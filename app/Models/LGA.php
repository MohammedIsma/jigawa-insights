<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
    protected $table = 'lgas';

    public function State()
    {
        return $this->belongsTo(State::class);
    }
    public function zone(){
        return $this->belongsTo(Zone::class);
    }
    public function Wards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ward::class, 'lga_id', 'id');
    }
    public function PollingUnits()
    {
        return $this->hasMany(PollingUnit::class, 'lga_id', 'id');
    }
    
}
