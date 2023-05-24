<?php

namespace App\Http\Controllers\Statistics;

use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Traits\DatesTrait;
use App\Http\Controllers\Controller;

class GraphicsController extends Controller
{
    public function getGraphicsLastYears()
    {
        try {
            $data = Sale::select('id', 'price', 'date')
                ->orderBy('date', 'ASC')
                ->get();

            $years = $data->pluck('date')->unique()->map( function($e) {
                return $e = Carbon::parse($e)->format('Y');
            })->unique()->values()->all();


            return response()->json(['message' => 'Consultado correctamente', 'data' => []]);
        } catch(\Exception $e) {
            return response($e);
        }
    }
}
