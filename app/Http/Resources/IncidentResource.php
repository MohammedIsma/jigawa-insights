<?php

namespace App\Http\Resources;

use App\Models\PollingUnit;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $L = getLGA($this->lga_id);
        $W = getWard($this->ward_id);
        $PU = getPollingUnit($this->polling_unit_id);

        return [
            "id" => $this->id,
            "ident" => $this->ident,
            "lga" => $L->name,
            "ward" => $W->name,
            "pu" => [
                "number" => $PU->number,
                "name" => $PU->name,
                "voter_count" => $PU->voter_count
            ],
            "description" => $this->description,
            "datetime" => $this->created_at->format("d-M h:ia")
        ];
    }
}
