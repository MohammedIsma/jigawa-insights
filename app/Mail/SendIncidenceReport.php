<?php

namespace App\Mail;

use App\Models\Incident;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendIncidenceReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $Incident;

    public function __construct(Incident  $i)
    {
        $this->Incident = $i;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
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

        return $this->view('mail.new_incidence', compact('String'));
    }
}
