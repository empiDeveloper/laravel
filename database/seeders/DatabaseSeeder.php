<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\StoreProduct;
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
        User::factory(1000)->create();

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

        Product::factory(2500)->create();

        $stores = Store::pluck('id');
        $products = Product::select('id', 'price')->get();
        $insertStoreProducts = collect([]);

        foreach ($stores as $index => $store) {
            for ($i = 0; $i < 2; $i++) {
                $productsStore = $insertStoreProducts->where('idStore', $store)->pluck('idProduct');
                $product = $products->whereNotIn('id', $productsStore)->pluck('id')->random();
                $insertStoreProducts[] = [
                    'state' => 1,
                    'idStore' => $store,
                    'idProduct' => $product,
                ];
            }
        }
        StoreProduct::insert($insertStoreProducts->shuffle()->values()->toArray());

        $users = User::whereType(2)->whereState(1)->pluck('id');
        $storeProducts = StoreProduct::select('id', 'idProduct')->where('state', 1)->get();
        $insertSales = collect([]);

        for ($i = 0; $i < 2; $i++) {
            $idStoreProduct = $storeProducts->pluck('id')->random();
            $storeProduct = $storeProducts->where('id', $idStoreProduct)->first();

            $insertSales[] = [
                'idStoreProduct' => $storeProduct->id,
                'price' => $products->where('id', $storeProduct->idProduct)->first()->price,
                'idUser' => $users->random(),
            ];
        }

        Sale::insert($insertSales->toArray());
    }
}
