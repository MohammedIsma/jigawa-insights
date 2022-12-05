<?php

namespace Database\Seeders;

use App\Models\Official;
use App\Models\OfficialType;
use Illuminate\Database\Seeder;

class OfficialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OfficialType::truncate();
        OfficialType::insert([
            [ "slug" => "fg_inec_official", "internal"=> false, "name"=> "INEC Official"],
            [ "slug" => "fg_state_official", "internal"=> false, "name"=> "State Electoral Officer"],
            [ "slug" => "party_official", "internal"=> false, "name"=> "Party Offficial"],
            [ "slug" => "committee_member", "internal"=> true, "name"=> "Committee Member"],
            [ "slug" => "committee_officer", "internal"=> true, "name"=> "Committee Officer"],
            [ "slug" => "volunteer", "internal"=> true, "name"=> "Volunteer"],
        ]);
    }
}
