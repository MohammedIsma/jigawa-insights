<?php

namespace Database\Seeders;

use App\Models\LGA;
use App\Models\Official;
use App\Models\PollingUnit;
use App\Models\Ward;
use Illuminate\Database\Seeder;

class OfficialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Official::truncate();
//        Official::factory()->count(1)->create([
//            'state_id' => 1,
//            'official_type_id' => 2,
//            "designation" => "State INEC Official"
//        ]);


//        foreach(LGA::all() as $lga){
//            Official::factory()->count(1)->create([
//                'official_type_id' => 2,
//                'lga_id' => $lga->id,
//                'state_id' => $lga->state_id,
//                "designation" => "LGA INEC Official"
//            ]);
//            Official::factory()->count(2)->create([
//                'official_type_id' => 3,
//                'lga_id' => $lga->id,
//                'state_id' => $lga->state_id,
//                "designation" => "APC Party Official"
//            ]);
//            Official::factory()->count(rand(1,3))->create([
//                'official_type_id' => 4,
//                'lga_id' => $lga->id,
//                'state_id' => $lga->state_id,
//                "designation" => "Committee Member"
//            ]);
//            Official::factory()->count(rand(1,7))->create([
//                'official_type_id' => 5,
//                'lga_id' => $lga->id,
//                'state_id' => $lga->state_id,
//                "designation" => "Committee Officer"
//            ]);
//        }

        foreach(Ward::all() as $Ward){
            Official::factory()->count(2)->create([
                'official_type_id' => 3,
                'ward_id' => $Ward->id,
                'lga_id' => $Ward->lga_id,
                'state_id' => $Ward->state_id,
                "designation" => "APC Ward Official"
            ]);
            Official::factory()->count(rand(7,15))->create([
                'official_type_id' => 6,
                'ward_id' => $Ward->id,
                'lga_id' => $Ward->lga_id,
                'state_id' => $Ward->state_id,
                "designation" => "Ward Volunteer"
            ]);
        }
//
//        foreach(PollingUnit::all() as $PU){
//            Official::factory()->count(4)->create([
//                'official_type_id' => 3,
//                'polling_unit_id' => $PU->id,
//                'ward_id' => $PU->ward_id,
//                'lga_id' => $PU->lga_id,
//                'state_id' => $PU->state_id,
//                "designation" => "APC PUnit Official"
//            ]);
//
//            Official::factory()->count(rand(4,10))->create([
//                'official_type_id' => 6,
//                'polling_unit_id' => $PU->id,
//                'ward_id' => $PU->ward_id,
//                'lga_id' => $PU->lga_id,
//                'state_id' => $PU->state_id,
//                "designation" => "PU Volunteer"
//            ]);
//        }

    }
}
