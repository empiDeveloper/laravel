<?php

namespace App\Http\Controllers\Others;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    public function getGeneralStatistics()
    {
        try {
            $data = DB::table('sales')
            ->select('sales.*')
            ->selectRaw("(SELECT users.name FROM users WHERE users.id = sales.idUser) AS vendedor")
            ->get();

            $response = [
                'countProducts' => $data->count(),
                'soldProducts' => $data->pluck('price')->sum(),
                'countStock' =>  $this->getStock(),
                'countSellers' => $this->getSellers(),
                'dollarTRM' => $this->getDollarTRM(),
            ];

            return response()->json(['message' => 'Consultado correctamente', 'data' => $response]);
        } catch(\Exception $e) {
            return response($e);
        }
    }

    public function getStock()
    {
        try {
            return DB::table('products')->whereState(1)->count();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function getSellers()
    {
        try {
            return DB::table('users')->whereState(1)->whereType(2)->count();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function getDollarTRM()
    {
        try {
            $apiUrl = 'https://api.exchangerate-api.com/v4/latest/USD';

            $data = file_get_contents($apiUrl);
            $result = json_decode($data, true);

            if ($result && isset($result['rates']['COP'])) {
                return round($result['rates']['COP']);
            }
            return 0;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
