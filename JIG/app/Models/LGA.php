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

    public function getLeadingPartyAttribute()
    {
        $R = VotingResult::selectRaw("political_party_id, SUM(count) as count")
            ->where("lga_id", $this->id)
            ->orderBy("count","desc")
            ->groupBy("political_party_id")
            ->first();
        return $R;
    }

    public function VotingResults(){
        return $this->hasMany(VotingResult::class, 'lga_id', 'id');
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

        return round(($acc_count/$pu_count) * 100, 1);
    }

    public function getAccreditedVotersAttribute($value){
        $ACC = AccreditationResult::where('lga_id', $this->id)->get();
        return $ACC ? $ACC->sum('accredited_count') : 0;
    }
}
