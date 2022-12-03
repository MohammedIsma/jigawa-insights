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
            [ "slug" => "fg_part_official", "internal"=> false, "name"=> "Party Offficial"],
            [ "slug" => "fg_internal_commettee", "internal"=> true, "name"=> "Commettee Memeber"],
            [ "slug" => "fg_internal_champion", "internal"=> true, "name"=> "Champion"],
            [ "slug" => "fg_internal_volunteer", "internal"=> true, "name"=> "Volunteer"],
        ]);
    }
}
