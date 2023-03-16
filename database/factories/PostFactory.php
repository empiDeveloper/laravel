<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(rand(20, 50)),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(25000, 5000000),
            'citie_id' => $this->faker->randomNumber(1, 200),
            'user_id' => $this->faker->randomNumber(1, 1000),
        ];
    }
}
