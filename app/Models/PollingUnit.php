<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    use HasFactory;


    public function LGA(){
        return $this->belongsTo(LGA::class, 'lga_id', 'id');
    }

    public function Ward(){
        return $this->belongsTo(Ward::class);
    }

    public function getAccreditationPercentageAttribute($value){
        $acc_count = AccreditationResult::where('polling_unit_id', $this->id)->count();

        return ($acc_count/1) * 100;
    }
}
