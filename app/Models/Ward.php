<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

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
        })->where(function($query){
            return $query->whereNull("ward_id")->where("lga_id", $this->id);
        })->orWhere(function($query){
            return $query->whereNull("lga_id")->where("state_id", $this->state_id);
        })->get();
    }

}
