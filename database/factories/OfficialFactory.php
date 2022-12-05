<?php

namespace Database\Factories;

use App\Models\LGA;
use App\Models\OfficialType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfficialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'official_type_id' => OfficialType::inRandomOrder()->first()->id,
            'lga_id' => LGA::inRandomOrder()->first()->id,
            'name' => $this->get_name(),
            'phone_number' => $this->faker->phoneNumber,
            'designation' => $this->faker->jobTitle,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
    }

    private function get_name(){
        $names = ["Abdulhamid", "Abdulkadir", "Abdullahi", "Abdurrahim", "Abdussalamu", "Abubakar", "Adamu", "", "Ahmad", "Ali", "Ango", "Baba", "Bako", "", "Balarabe", "Barau", "Bawa", "Dauda", "", "Dogo", "Dan A", "ltine Dan Asabe", "", "Dan Azumi", "Dan Kaka", "Danjuma", "Danladi", "Danlami", "Dantala", "Faruku", "Gagarau", "Gajere", "Ganau", "Hafizu", "Hakurau", "Halilu", "Hamidu", "Haruna", "Hasan", "Husaini", "Ibrahim", "Isa", "Isiyaku", "Isma'ilu", "Jatau", "Jibirilu", "Kaka", "Kawu", "kosau", "Magaji", "Mahmudu", "Maigari", "Maikudi", "Maina", "Mairiga", "Maitama", "Maiwada", "Mantau", "Mohammed", "Muhammadu", "Muhtari", "Musa", "Mustapha", "Na-Allah", "Nuhu", "Sabo", "Sadau", "Sallau", "Samɓali", "Sarki", "Shanono", "Shekarau", "Sulemanu", "Tanimu", "Tunau", "Umaru", "Usumanu", "Yakubu", "Yalwa", "Yusufu", "Zubairu"];
        return sprintf("%s %s", $names[array_rand($names)], $names[array_rand($names)]);
    }
}
