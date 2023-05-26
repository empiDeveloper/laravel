<?php

namespace App\Http\Controllers\Statistics;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Store;

class GraphicsController extends Controller
{
    public function getGraphicsLastYears()
    {
        try {
            $data = Sale::select('price')
                ->selectRaw("(SELECT YEAR(date) AS year) AS year")
                ->orderBy('year', 'ASC')
                ->get();

            $response = $data->groupBy('year')->map( function($items, $key) {
                return [
                    'year' => $key,
                    'amount' => $items->sum('price'),
                ];
            })->values();

            return response()->json(['message' => 'Consultado correctamente', 'data' => $response]);
        } catch(\Exception $e) {
            return response($e);
        }
    }

    public function getGraphicCatalog()
    {
        try {
            $data = Sale::select('type')->orderBy('type')->get();
            $group = $data->groupBy('type')->map( function($items, $key) {
                return [
                    'name' => $this->identifyStrategy($key),
                    'value' => $items->where('type', $key)->count()
                ];
            })->sortByDesc('items')->values();

            return response()->json(['message' => 'Consultado correctamente', 'data' => $group]);
        } catch(\Exception $e) {
            return response($e);
        }
    }

    public function identifyStrategy(int $strategy)
    {
        try {
            switch ($strategy) {
                case 1:
                    return 'Catálogo';
                case 2:
                    return 'Plataforma web';
                case 3:
                    return 'WhatsApp';
                default:
                    return 'No identificada';
            }
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function getGraphicStores()
    {
        try {
            $response = Store::select('id', 'state', 'name')
            ->selectRaw("(
                SELECT
                    SUM(s.price)
                FROM
                    stores_products sp
                INNER JOIN
                    sales s
                ON
                    sp.id = s.idStoreProduct
                WHERE
                    sp.idStore = stores.id
            ) AS totalSales")
            ->selectRaw("(
                SELECT
                    COUNT(s.id)
                FROM
                    stores_products sp
                INNER JOIN
                    sales s
                ON
                    sp.id = s.idStoreProduct
                WHERE
                    sp.idStore = stores.id
            ) AS countProducts")
            ->orderBy('totalSales', 'DESC')
            ->get();

            return response()->json(['message' => 'Consultado correctamente', 'data' => $response]);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
