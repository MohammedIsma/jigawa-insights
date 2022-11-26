<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = [
        'state_name'
    ];

    public function lga()
    {
        return $this->hasMany(LGA::class);
    }

    public function ward()
    {
        return $this->hasMany(Ward::class);
    }
}
