<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insert admin
        /*
        User::insert([
            'state' => 1,
            'name' => 'Administrador',
            'type_id' => 1,
            'email' => 'admin@admin.com',
            'phone' => '123123',
        ]);
        */
        // Run factories
        Category::insert([
            ['state' => 1, 'name' => 'Tecnología'],
            ['state' => 1, 'name' => 'Accesorios'],
            ['state' => 1, 'name' => 'Deportes'],
            ['state' => 1, 'name' => 'Videojuegos'],
            ['state' => 1, 'name' => 'Electrodomésticos'],
            ['state' => 1, 'name' => 'Ropa'],
            ['state' => 1, 'name' => 'Calzado'],
            ['state' => 1, 'name' => 'Cosméticos'],
            ['state' => 1, 'name' => 'Alimentación'],
            ['state' => 1, 'name' => 'Salud'],
            ['state' => 1, 'name' => 'Otros'],
        ]);

        User::factory(1000)->create();

        Store::insert([
            ['state' => 1, 'name' => 'Alkomprar'],
            ['state' => 1, 'name' => 'Alkosto'],
            ['state' => 1, 'name' => 'Mercagan'],
            ['state' => 1, 'name' => 'Suite Good'],
            ['state' => 1, 'name' => 'House Tecnology'],
            ['state' => 1, 'name' => 'Dafiti'],
            ['state' => 1, 'name' => 'Mercado Libre'],
            ['state' => 1, 'name' => 'Amazon'],
            ['state' => 1, 'name' => 'Alibaba Group'],
            ['state' => 1, 'name' => 'Dev Company'],
            ['state' => 1, 'name' => 'Mazda'],
            ['state' => 0, 'name' => 'Amazon Two'],
            ['state' => 0, 'name' => 'Suite Group'],
            ['state' => 0, 'name' => 'Pepa la Comercial'],
            ['state' => 1, 'name' => 'Avenida 27'],
            ['state' => 1, 'name' => 'Belleza Total'],
        ]);
    }
}
