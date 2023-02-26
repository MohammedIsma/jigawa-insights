<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    public $fillable = [
        'name' ,
        'phone_number',
        'designation',
        'official_type_id',
        'state_id',
        'lga_id',
        'ward_id',
        'pollingUnit_id',
    ];

    public function OfficialType(){
        return $this->belongsTo(OfficialType::class);
    }
}
