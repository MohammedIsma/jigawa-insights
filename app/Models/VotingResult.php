<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingResult extends Model
{
    protected $guarded = [];

    public function Party(){
        return $this->belongsTo(PoliticalParty::class, "political_party_id", "id");
    }
}
