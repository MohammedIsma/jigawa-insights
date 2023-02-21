<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
    protected $table = 'lgas';
    protected $guarded = [];

    public function State()
    {
        return $this->belongsTo(State::class);
    }

    public function Officials(){
        return Official::where(function($query){
                return $query->whereNull("ward_id")->where("lga_id", $this->id);
            })
            ->orWhere(function($query){
                return $query->whereNull("lga_id")->where("state_id", $this->state_id);
            })
            ->get();
    }

    public function PollingUnits(){
        return $this->hasMany(PollingUnit::class, 'lga_id', 'id');
    }
    public function Wards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ward::class, 'lga_id', 'id');
    }

    public function getAccreditationPercentageAttribute($value){
        $pu_count = $this->PollingUnits->count();
        $acc_count = AccreditationResult::where('lga_id', $this->id)->count();

        return ($acc_count/$pu_count) * 100;
    }
}
