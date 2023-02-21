<?php

namespace Database\Seeders;

use App\Models\PoliticalParty;
use Illuminate\Database\Seeder;

class PoliticalPartiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PoliticalParty::truncate();
        PoliticalParty::insert([
            [ "slug" => "apc" , "name" => "All Progressives Congress"],
            [ "slug" => "pdp" , "name" => "People's Democratic Party"],
            [ "slug" => "nnpp" , "name" => "NNPP"],
        ]);
    }
}
