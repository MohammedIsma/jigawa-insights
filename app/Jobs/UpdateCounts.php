<?php

namespace App\Jobs;

use App\Models\LGA;
use App\Models\Ward;
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

    public function __construct($ward_ids=null){
        if($ward_ids){
            $this->Wards = Ward::whereIn('id', $ward_ids)->get();
            $this->LGAs = LGA::whereIn('id', $this->Wards->pluck('lga_id')->toArray())->get();
        }else{
            $this->Wards = Ward::all();
            $this->LGAs = LGA::all();
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
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
