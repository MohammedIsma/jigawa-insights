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
            [ "logo" => "/images/parties/A.jpg", "name" => "Accord", "slug"=>"A"],
            [ "logo" => "/images/parties/AA.jpg", "name" => "Action Alliance", "slug"=>"AA"],
            [ "logo" => "/images/parties/ADP.png", "name"=>"Action Democratic Party", "slug"=>"ADP"],
            [ "logo" => "/images/parties/APP.png", "name"=>"Action Peoples Party", "slug"=>"APP"],
            [ "logo" => "/images/parties/AAC.jpg", "name" => "African Action Congress", "slug"=>"AAC"],
            [ "logo" => "/images/parties/ADC.jpg", "name" => "African Democratic Congress", "slug"=>"ADC"],
            [ "logo" => "/images/parties/apclogo.jpg", "name" => "All Progressives Congress", "slug"=>"APC"],
            [ "logo" => "/images/parties/APGA.jpg", "name" => "All Progressives Grand Alliance", "slug"=>"APGA"],
            [ "logo" => "/images/parties/APM.jpg", "name" => "Allied Peoples Movement", "slug"=>"APM"],
            [ "logo" => "/images/parties/BootParty.jpg", "name" => "Boot Party", "slug"=>"BP"],
            [ "logo" => "/images/parties/LP.jpg", "name" => "Labour Party", "slug"=>"LP"],
            [ "logo" => "/images/parties/NRM.png", "name"=>"National Rescue Movement", "slug"=>"NRM"],
            [ "logo" => "/images/parties/NNPP.jpg", "name" => "New Nigeria Peoples Party", "slug"=>"NNPP"],
            [ "logo" => "/images/parties/PDP.jpg", "name" => "Peoples Democratic Party", "slug"=>"PDP"],
            [ "logo" => "/images/parties/PRP.png", "name"=>"Peoples Redemption Party", "slug"=>"PRP"],
            [ "logo" => "/images/parties/SDP.png", "name"=>"Social Democratic Party", "slug"=>"SDP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2021/04/YPP-Logo.jpeg", "name"=>"Young Progressive Party", "slug"=>"YPP"],
            [ "logo" => "/images/parties/ZLP.jpg", "name" => "Zenith Labour Party", "slug"=>"ZLP"]
        ]);
    }
}
