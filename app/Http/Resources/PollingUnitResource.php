<?php

namespace App\Http\Resources;

use App\Models\AccreditationResult;
use App\Models\PoliticalParty;

use Illuminate\Http\Resources\Json\JsonResource;

class PollingUnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $reported = AccreditationResult::where("polling_unit_id", $this->id)->count() > 0;
        $lead_party = $this->leading_party;
        // dd($lead_party);

        $lp = [
            "id" => $this->id,
            "name" => $this->name,
            "voter_count" => $this->voter_count,
            "accredited_count" => number_format($this->accredited_count_1),
            "is_reported" => $reported,
            "turnout" => round(($this->accredited_count_1/$this->voter_count) * 100, 2),
        ];

        if($lead_party){
            $Party = PoliticalParty::find($lead_party->political_party_id);
            $lp["leading_party_slug"] = $Party->slug;
            $lp["leading_party_name"] = $Party->name;
            $lp["leading_party_logo"] = $Party->logo ;
        }

        return $lp;
    }
}
