<?php

namespace App\Jobs;

use App\Models\Incident;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendIncidenceReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $Incident;

    public function __construct(Incident  $i)
    {
        $this->Incident = $i;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $PollingUnit = $this->Incident->PollingUnit;

        $String = sprintf("%s\n%s\n==================\nLGA  : %s\nWard : %s\nPUnit: %s\nDELIM: %s\n------------------\n%s",
            "INCIDENCE REPORT",
            $this->Incident->created_at->format("d M h:ia"),
            $PollingUnit->LGA->name,
            $PollingUnit->Ward->name,
            $PollingUnit->name,
            $PollingUnit->number,
            $this->Incident->description,
        );
        exit;
    }
}
