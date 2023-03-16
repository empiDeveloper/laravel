<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->state(20),
            'countrie_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
        ];
    }
}
