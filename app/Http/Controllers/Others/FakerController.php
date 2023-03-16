<?php

namespace App\Http\Controllers\Others;

use Faker\Factory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FakerController extends Controller
{
    public function postUsers()
    {
        try {
            $faker = Factory::create();
            $insert = [];

            for($i = 0; $i < 1; $i++){
                $fileName = $faker->numberBetween(1,10). '.jpg';

                $insert = [
                    'state' => $faker->randomElement([1,0]),
                    'name' => $faker->name(50),
                    'type_id' => $faker->randomElement([2,3,4,5]),
                    'email' => $faker->unique()->safeEmail,
                    'phone' => $faker->unique()->phoneNumber,
                    'city_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12,13]),
                ];
            }

            DB::transaction(function() use($insert){
                User::insert($insert);
                return response(['message' => 'Usuarios creados correctamente', 'data' => true], 201);
            },2);
        } catch(\Exception $e) {
            return response($e);
        }
    }
}
