<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'state' => $this->faker->randomElement([1,0]),
            'idCategory' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10,11]),
            'name' => $this->faker->sentence(2),
            'price' => $this->faker->numberBetween(10000, 5000000),
        ];
    }
}
