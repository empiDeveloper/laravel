<?php

namespace App\Http\Controllers\Statistics;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
