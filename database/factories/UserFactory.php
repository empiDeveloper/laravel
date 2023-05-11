<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fileName = $this->faker->numberBetween(1,7). '.jpg';

        return [
            'state' => $this->faker->randomElement([0,1]),
            'type' => 2,
            'name' => $this->faker->firstName." ".$this->faker->lastName,
            'image' => "img/users/{$fileName}",
        ];
    }
}
