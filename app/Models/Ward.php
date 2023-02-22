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

        return ($acc_count/$pu_count) * 100;
    }

    public function getAccreditedVotersAttribute($value){
        $ACC = AccreditationResult::where('ward_id', $this->id)->first();
        return $ACC ? $ACC->sum('count') : 0;
    }

    public function getTurnoutAttribute($value){

        $Res = AccreditationResult::where('ward_id', $this->id)->get();
        if(!$Res){
            return 0;
        }

        $vcount = $this->PollingUnits->sum('voter_count');
        return round(($Res->sum('count')/$vcount) * 100, 2);
    }

}
