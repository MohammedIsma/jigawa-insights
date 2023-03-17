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
            [ "logo" => "/image/parties/A.jpg", "name" => "Accord", "slug"=>"A"],
            [ "logo" => "/image/parties/AA.jpg", "name" => "Action Alliance", "slug"=>"AA"],
            [ "logo" => "/image/parties/ADP.png", "name"=>"Action Democratic Party", "slug"=>"ADP"],
            [ "logo" => "/image/parties/APP.png", "name"=>"Action Peoples Party", "slug"=>"APP"],
            [ "logo" => "/image/parties/AAC.jpg", "name" => "African Action Congress", "slug"=>"AAC"],
            [ "logo" => "/image/parties/ADC.jpg", "name" => "African Democratic Congress", "slug"=>"ADC"],
            [ "logo" => "/image/parties/apclogo.jpg", "name" => "All Progressives Congress", "slug"=>"APC"],
            [ "logo" => "/image/parties/APGA.jpg", "name" => "All Progressives Grand Alliance", "slug"=>"APGA"],
            [ "logo" => "/image/parties/APM.jpg", "name" => "Allied Peoples Movement", "slug"=>"APM"],
            [ "logo" => "/image/parties/BootParty.jpg", "name" => "Boot Party", "slug"=>"BP"],
            [ "logo" => "/image/parties/LP.jpg", "name" => "Labour Party", "slug"=>"LP"],
            [ "logo" => "/image/parties/NRM.png", "name"=>"National Rescue Movement", "slug"=>"NRM"],
            [ "logo" => "/image/parties/NNPP.jpg", "name" => "New Nigeria Peoples Party", "slug"=>"NNPP"],
            [ "logo" => "/image/parties/PDP.jpg", "name" => "Peoples Democratic Party", "slug"=>"PDP"],
            [ "logo" => "/image/parties/PRP.png", "name"=>"Peoples Redemption Party", "slug"=>"PRP"],
            [ "logo" => "/image/parties/SDP.png", "name"=>"Social Democratic Party", "slug"=>"SDP"],
            [ "logo" => "/image/parties/YPP-Logo.jpeg", "name"=>"Young Progressive Party", "slug"=>"YPP"],
            [ "logo" => "/image/parties/ZLP.jpg", "name" => "Zenith Labour Party", "slug"=>"ZLP"],
            [ "logo" => "/image/parties/invalid.png", "name" => "**INVALID**", "slug"=>"invalid"]
        ]);
    }
}
