<?php

namespace App\Http\Resources;

use App\Models\AccreditationResult;
use Illuminate\Http\Resources\Json\JsonResource;

class LGAResource extends JsonResource
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
        $reported_pus = AccreditationResult::where("lga_id", $this->id)->count();

        return [
            "id" => $this->id,
            "name" => $this->name,
            "polling_unit_count" => $this->PollingUnits->count(),
            "ward_count" => $this->Wards->count(),
            "voter_count" => number_format($vcount),
            "accredited_count" => number_format($acount),
            "reported_pu_count" => $reported_pus,
            "turnout" => round(($acount/$vcount) * 100, 2),
        ];
    }
}
