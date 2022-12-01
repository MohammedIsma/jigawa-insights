<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    use HasFactory;


    public function lga()
    {
        return $this->belongsTo(LGA::class, 'lga_id', 'id');
    }
}
