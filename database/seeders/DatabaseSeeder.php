<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Http\Traits\FactoryTrait;

class DatabaseSeeder extends Seeder
{
    use FactoryTrait;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insert admin
        User::insert([
            'state' => 1,
            'type' => 1,
            'name' => 'Administrador',
        ]);

        // Run factories
        User::factory(1000)->create();
        $this->factoryCategories();
        Product::factory(2500)->create();
        $this->factoryStores();
        $this->factoryStoreProducts();
        $this->factorySales();
    }
}
