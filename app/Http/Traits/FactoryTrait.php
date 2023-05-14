<?php
namespace App\Http\Traits;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\Sale;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\DB;

trait FactoryTrait {

    public static function factoryCategories()
    {
        try {
            return DB::transaction(function(){
                return Category::insert([
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
            },2);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function factoryStores()
    {
        try {
            return DB::transaction(function(){
                return Store::insert([
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
            },2);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function factoryStoreProducts()
    {
        try {
            return DB::transaction(function(){
                $stores = Store::pluck('id');
                $products = Product::select('id', 'price')->get();
                $insertStoreProducts = collect([]);

                foreach ($stores as $index => $store) {
                    for ($i = 0; $i < 100; $i++) {
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
            },2);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function factorySales()
    {
        try {
            return DB::transaction(function(){
                $products = Product::select('id', 'price')->get();
                $users = User::whereType(2)->whereState(1)->pluck('id');
                $storeProducts = StoreProduct::select('id', 'idProduct')->where('state', 1)->get();
                $insertSales = collect([]);
                $faker = Factory::create();

                $lastDate = Carbon::now()->subYears(2);

                $actualDate = Carbon::now();
                $diff = $lastDate->diffInDays($actualDate);
                $dates = collect([]);
                $dateCycle = $lastDate;
                $dates->push($lastDate->format('Y-m-d'));

                for ($i = 0; $i < intval($diff); $i++) {
                    $date = $dateCycle->addDay();
                    $dateCycle = $date;
                    $dates[] = $date->format('Y-m-d');
                }

                for ($i = 0; $i < 3000; $i++) {
                    $idStoreProduct = $storeProducts->pluck('id')->random();
                    $storeProduct = $storeProducts->where('id', $idStoreProduct)->first();

                    $insertSales[] = [
                        'type' => $faker->randomElement([1,2,3]),
                        'idStoreProduct' => $storeProduct->id,
                        'price' => $products->where('id', $storeProduct->idProduct)->first()->price,
                        'date' => $dates->random(),
                        'idUser' => $users->random(),
                    ];
                }

                Sale::insert($insertSales->sortBy('date')->values()->toArray());
            },2);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
