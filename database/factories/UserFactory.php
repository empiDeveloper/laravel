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
            'state' => $this->faker->randomElement([1,0]),
            'type_id' => $this->faker->randomElement([1,2,3,4,5]),
            'name' => $this->faker->name(50),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'image' => "img/users/{$fileName}",
            'citie_id' => $this->faker->randomNumber(1,200),
            'password' => bcrypt("123123")
        ];
    }
}
