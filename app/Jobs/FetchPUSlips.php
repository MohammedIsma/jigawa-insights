<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FetchPUSlips implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $PUs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pu)
    {
        $this->PUs = $pu;
    }

    public function handle()
    {
        foreach($this->PUs as $pu){

            $state = getState(1);
            $lga = getLGA($pu->lga_id);

            $str = sprintf("https://forensic.nigeria2.com/app/images/%s/%s/%s.jpg",
                Str::slug($state->name),
                Str::slug($lga->name),
                $pu->number
            );
            try {
                $x = Storage::disk('local')
                    ->put(
                        "pu_images/" . $state->name . "/" . $lga->name . "/" . $pu->number . '.png',
                        file_get_contents($str)
                    );
                if($x==true){
                    $pu->update(['has_image'=>'1']);
                }else{
                    dd($x);
                }
            }catch (\Exception $e){
                $pu->update(['has_image'=>'404']);
            }

            sleep(1);
        }
    }
}
