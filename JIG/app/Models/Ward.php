<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'ward_name',
    ];



    public function State(){
        return $this->belongsTo(State::class);
    }
    public function LGA(){
        return $this->belongsTo(LGA::class, 'lga_id', 'id');
    }
    public function PollingUnits(){
        return $this->hasMany(PollingUnit::class);
    }

    public function VotingResults(){
        return $this->hasMany(VotingResult::class);
    }

    public function getLeadingPartyAttribute()
    {
        $R = VotingResult::selectRaw("political_party_id, SUM(count) as count")
            ->where("ward_id", $this->id)
            ->orderBy("count","desc")
            ->groupBy("political_party_id")
            ->first();
        return $R;
    }

    public function Officials(){
        return Official::where(function($query){
            return $query->whereNull("polling_unit_id")->where("ward_id", $this->id);
        })->orWhere(function($query){
            return $query->whereNull("ward_id")->where("lga_id", $this->id);
        })->orWhere(function($query){
            return $query->whereNull("lga_id")->where("state_id", $this->state_id);
        })->get();
    }

    public function getAccreditationPercentageAttribute($value){
        $pu_count = $this->PollingUnits->count();
        $acc_count = AccreditationResult::where('ward_id', $this->id)->count();

        return round(($acc_count/$pu_count) * 100, 1);
    }

    public function getAccreditedVotersAttribute($value){
        $ACC = AccreditationResult::where('ward_id', $this->id)->get();
        return $ACC ? $ACC->sum('accredited_count') : 0;
    }


    public function getReportedPercentageAttribute($value){
        $reported_pus = AccreditationResult::where("ward_id", $this->id)->count();
        return round(($reported_pus/$this->PollingUnits->count()) * 100, 1);
    }

    public function getTurnoutAttribute($value){

        $Res = AccreditationResult::where('ward_id', $this->id)->get();
        if(!$Res){
            return 0;
        }

        $vcount = $this->PollingUnits->sum('voter_count');
        return round(($Res->sum('accredited_count')/$vcount) * 100, 2);
    }

}
