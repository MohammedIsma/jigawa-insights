<?php

namespace Database\Factories;

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

            'officialType_id' => OfficialType::first(),
            'name' => $this->faker->word,
            'phone_number' => $this->faker->phoneNumber,
            'designation' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            ];
    }
}
