<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Countrie;
use App\Models\Post;
use App\Models\State;
use App\Models\User;
use App\Models\UserType;
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
        Countrie::factory(10)->create();
        State::factory(20)->create();
        City::factory(200)->create();
        UserType::factory(5)->create();
        User::factory(1000)->create();
        Post::factory(5000)->create();
    }
}
