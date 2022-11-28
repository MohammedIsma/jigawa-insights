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

    public function pollingUnit()
    {
        return $this->hasMany(PollingUnit::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function lga()
    {
        return $this->belongsTo(LGA::class, 'lga_id', 'id');
    }

}
