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
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/A.jpg", "name" => "Accord", "slug"=>"A"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/AA.jpg", "name" => "Action Alliance", "slug"=>"AA"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/ADP.png", "name"=>"Action Democratic Party", "slug"=>"ADP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/APP.png", "name"=>"Action Peoples Party", "slug"=>"APP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/AAC.jpg", "name" => "African Action Congress", "slug"=>"AAC"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/ADC.jpg", "name" => "African Democratic Congress", "slug"=>"ADC"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/apclogo.jpg", "name" => "All Progressives Congress", "slug"=>"APC"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/APGA.jpg", "name" => "All Progressives Grand Alliance", "slug"=>"APGA"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/APM.jpg", "name" => "Allied Peoples Movement", "slug"=>"APM"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2019/09/BootParty.jpg", "name" => "Boot Party", "slug"=>"BP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/LP.jpg", "name" => "Labour Party", "slug"=>"LP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/NRM.png", "name"=>"National Rescue Movement", "slug"=>"NRM"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/NNPP.jpg", "name" => "New Nigeria Peoples Party", "slug"=>"NNPP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/PDP.jpg", "name" => "Peoples Democratic Party", "slug"=>"PDP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/PRP.png", "name"=>"Peoples Redemption Party", "slug"=>"PRP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/SDP.png", "name"=>"Social Democratic Party", "slug"=>"SDP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2021/04/YPP-Logo.jpeg", "name"=>"Young Progressive Party", "slug"=>"YPP"],
            [ "logo" => "https://inecnigeria.org/wp-content/uploads/2018/10/ZLP.jpg", "name" => "Zenith Labour Party", "slug"=>"ZLP"]
        ]);
    }
}
