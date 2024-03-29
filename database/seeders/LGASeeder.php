<?php

namespace Database\Seeders;

use App\Models\LGA;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Seeder;

class LGASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        LGA::truncate();
        $csvData = fopen(base_path('database/csv/jigawa.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 4523, ',')) !== false) {
            if (!$transRow) {
                $State = State::firstOrCreate([
                    'name' => $data[1]
                ]);

                $LGA = LGA::firstOrCreate([
                    'state_id' => $State->id,
                    'name' => $data[2],
                ]);

                $ward = Ward::firstOrCreate([
                    'lga_id' => $LGA->id,
                    'state_id' => $State->id,
                    'name' => $data[3]
                ]);

                PollingUnit::firstOrCreate([
                    'name' => $data[4],
                    'ward_id' => $ward->id,
                    'lga_id'  => $LGA->id,
                    'number'  => $data[5],
                    'voter_count'  => $data[6]
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);

        User::where("id", 1)->update([
            "allowed_wards" => Ward::pluck("id")->toArray(),
            "allowed_lgas" => LGA::pluck("id")->toArray(),
        ]);

    }
}
