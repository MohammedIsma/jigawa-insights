<?php

namespace App\Http\Resources;

use App\Models\AccreditationResult;
use App\Models\PoliticalParty;

use Illuminate\Http\Resources\Json\JsonResource;

class WardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $vcount = $this->PollingUnits->sum("voter_count");
        $acount = $this->PollingUnits->sum("accredited_count_1");
        $reported_pus = AccreditationResult::where("ward_id", $this->id)->count();
        $lead_party = $this->leading_party;
        // dd($lead_party);

        $lp = [
            "id" => $this->id,
            "name" => $this->name,
            "polling_unit_count" => $this->PollingUnits->count(),
            "voter_count" => number_format($vcount),
            "accredited_count" => number_format($acount),
            "reported_pu_count" => $reported_pus,
            "turnout" => round(($acount/$vcount) * 100, 2),
            "reported_pus" => $reported_pus,
            "reported_percentage" => $this->reported_percentage
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
