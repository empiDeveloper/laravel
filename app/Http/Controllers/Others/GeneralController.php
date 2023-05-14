<?php

namespace App\Http\Controllers\Others;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getGeneralStatistics()
    {
        try {
            $data = Sale::select('sales.*')
            ->selectRaw("(SELECT users.name FROM users WHERE users.id = sales.idUser) AS vendedor")
            ->get();

            $response = [
                'countProducts' => $data->count(),
                'soldProducts' => $data->pluck('price')->sum(),
                'bestStrategy' =>  $this->getBestStrategy($data),
                'bestSeller' => $this->getBestSeller($data)
            ];

            return response()->json(['message' => 'Consultado correctamente', 'response' => $response]);
        } catch(\Exception $e) {
            return response($e);
        }
    }

    public function getBestStrategy($sales)
    {
        try {
            $bestStrategy = $sales->groupBy('type')->map(function($items, $key){
                return [
                    'strategy' => intval($key),
                    'items' => $items->count()
                ];
            })->sortByDesc('items')->values()->first();

            switch($bestStrategy['strategy']){
                case 1:
                    return 'Catálogo';
                case 2:
                    return 'Plataforma web';
                case 3:
                    return 'WhatsApp';
                default:
                    return 'No definida';
            }
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function getBestSeller($sales)
    {
        try {
            $bestSeller = $sales->pluck('idUser')->unique()->map(function($e) use($sales){
                return [
                    'id' => $e,
                    'vendedor' => $sales->where('idUser', $e)->first()->vendedor,
                    'total' => $sales->where('idUser', $e)->sum('price'),
                ];
            })->sortByDesc('total')
                ->values()
                ->first();

            return $bestSeller['vendedor'] ?? 'No definido';
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
