<?php

namespace App\Http\Controllers\Statistics;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Traits\DatesTrait;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{
    public function getDataCards()
    {
        try {
            $month = DatesTrait::getRangeMonth();
            $year = DatesTrait::getRangeYear();
            $lastMonth = DatesTrait::getRangeLastMonth();

            $response = Sale::select('price', 'date')
                ->whereDate('date', '>=', $year->startOfYear)
                ->whereDate('date', '<=', $year->endOfYear)
                ->get();

            $dataMonth = $response->where('date', '>=', $month->startOfMonth)
                ->where('date','<=', $month->endOfMonth)
                ->sum('price');

            $dataYear = $response->sum('price');

            $dataLastMonth = $response->where('date', '>=', $lastMonth->startOfMonth)
                ->where('date', '<=', $lastMonth->endOfMonth)
                ->sum('price');

            $data = (object)[
                'month' => $dataMonth,
                'objetive' => 500000000,
                'lastMonth' => $dataLastMonth,
                'year' => $dataYear,
            ];

            return response()->json(['message' => 'Consultado correctamente', 'data' => $data]);
        } catch(\Exception $e) {
            return response($e);
        }
    }
}
