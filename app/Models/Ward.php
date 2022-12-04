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

}
