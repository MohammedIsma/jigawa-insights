<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    protected $guarded = [];

    public function LGA(){
        return $this->belongsTo(LGA::class, 'lga_id', 'id');
    }

    public function Ward(){
        return $this->belongsTo(Ward::class);
    }

    public function getAccreditationPercentageAttribute($value){

        $Res = AccreditationResult::where('polling_unit_id', $this->id)->first();
        if(!$Res){
            return 0;
        }
        return 100;
    }

    public function getAccreditedVotersAttribute($value){
        $ACC = AccreditationResult::where('polling_unit_id', $this->id)->first();
        return $ACC ? $ACC->count : 0;
    }

    public function getTurnoutAttribute($value){

        $Res = AccreditationResult::where('polling_unit_id', $this->id)->first();

        if(!$Res){
            return 0;
        }

        return round(($Res->count/$this->voter_count) * 100, 2);
    }
}
