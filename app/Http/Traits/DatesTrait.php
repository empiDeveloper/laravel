<?php
namespace App\Http\Traits;

use Carbon\Carbon;

trait DatesTrait {

    public static function getRangeMonth()
    {
        try {
            $date = Carbon::now();
            return (object)[
                'startOfMonth' => $date->startOfMonth()->format('Y-m-d'),
                'endOfMonth' => $date->endOfMonth()->format('Y-m-d'),
            ];
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function getRangeYear()
    {
        try {
            $date = Carbon::now();
            return (object)[
                'startOfYear' => $date->startOfYear()->format('Y-m-d'),
                'endOfYear' => $date->endOfYear()->format('Y-m-d'),
            ];
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function getRangeLastMonth()
    {
        try {
            $date = Carbon::now()->subMonth();
            return (object)[
                'startOfMonth' => $date->startOfMonth()->format('Y-m-d'),
                'endOfMonth' => $date->endOfMonth()->format('Y-m-d'),
            ];
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function getDifferenceInYears($lastYear, $currentYear)
    {
        try {
            $lastYear = Carbon::parse($lastYear);
            $currentYear = Carbon::parse($currentYear);
            $differente = $lastYear->diffInYears($currentYear);

            return (object)[
                'firstYear' => $lastYear->startOfYear()->format('Y-m-d'),
                'lastYear' => $currentYear->endOfYear()->format('Y-m-d'),
                'difference' => $differente,
            ];
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
