<?php

namespace App\Http\Controllers\Sellers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function getSellers(Request $request)
    {
        try {
            $filter = $request->filter ?? 'sales';

            $response = DB::table('users')
            ->select('id', 'name', 'image')
            ->selectRaw("(SELECT SUM(sales.price) FROM sales WHERE sales.idUser = users.id) AS countSales")
            ->selectRaw("(SELECT COUNT(*) FROM sales WHERE sales.idUser = users.id) AS countProducts")
            ->where('type', 2)
            ->when($filter == 'sales', function($query){
                $query->orderByDesc('countSales');
            }, function($query){
                $query->orderByDesc('countProducts');
            })
            ->limit(10)
            ->get();

            return response()->json(['message' => 'Consultado correctamente', 'data' => $response]);
        } catch(\Exception $e) {
            return response($e);
        }
    }
}
