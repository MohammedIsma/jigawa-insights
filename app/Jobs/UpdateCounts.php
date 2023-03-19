<?php

namespace App\Jobs;

use App\Models\LGA;
use App\Models\Ward;
use App\Models\PollingUnit;
use App\Models\VotingResult;
use App\Models\AccreditationResult;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCounts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $Wards;
    protected $LGAs;
    protected $PUs;

    public function __construct($ward_ids=null){
        if($ward_ids){
            $this->Wards = Ward::whereIn('id', $ward_ids)->get();
            $this->LGAs = LGA::whereIn('id', $this->Wards->pluck('lga_id')->toArray())->get();
            $this->PUs = PollingUnit::whereIn("ward_id", $ward_ids)->get();
        }else{
            $this->Wards = Ward::all();
            $this->LGAs = LGA::all();
            $this->PUs = PollingUnit::whereIn('id', "x")->get();
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->PUs as $P){
            $Vr = VotingResult::where('polling_unit_id', $P->id)->sum('count');
            $Vc = VotingResult::where('polling_unit_id', $P->id)->count();

            if($Vc>0){
                if($Vr < 1){
                    $P->update(["accredited_count_1"=>0]);
                    AccreditationResult::updateOrCreate([
                        "state_id" => 1,
                        "lga_id" => $P->lga_id,
                        "ward_id" => $P->ward_id,
                        "polling_unit_id" => $P->id,
                    ],[
                        "user_id" => auth()->user()->id,
                        "box_count" => 1,
                        "voter_count" => $P->voter_count,
                        "accredited_count" => 0
                    ]);
                }else{
                    $Ar = AccreditationResult::firstOrCreate([
                        "state_id" => 1,
                        "lga_id" => $P->lga_id,
                        "ward_id" => $P->ward_id,
                        "polling_unit_id" => $P->id,
                    ],[
                        "user_id" => 1,
                        "box_count" => 1,
                        "voter_count" => $P->voter_count,
                        "accredited_count" => $Vr
                    ]);
                    $P->update(["accredited_count_1"=>(int)$Vr]);
                }
            }
        }

        foreach($this->Wards as $W){
            $W->update([
                "voter_count" => $W->PollingUnits->sum("voter_count"),
                "accredited_count_1" => $W->PollingUnits->sum("accredited_count_1"),
                "accredited_count_2" => $W->PollingUnits->sum("accredited_count_2"),
            ]);
        }

        foreach($this->LGAs as $L){
            $L->update([
                "voter_count" => $L->Wards->sum("voter_count"),
                "accredited_count_1" => $L->Wards->sum("accredited_count_1"),
                "accredited_count_2" => $L->Wards->sum("accredited_count_2"),
            ]);
        }
    }
}
