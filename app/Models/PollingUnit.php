<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    use HasFactory;


    public function zone(){
        return $this->belongsTo(Zone::class);
    }
    
    public function LGA(){
        return $this->belongsTo(LGA::class, 'lga_id', 'id');
    }

    public function Ward(){
        return $this->belongsTo(Ward::class);
    }
}
