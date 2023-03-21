<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User\GetUsersRequest;

class UserController extends Controller
{
    public function getUsers(GetUsersRequest $request)
    {
        try {
            $users = User::select('id', 'name', 'image')
            ->addSelect(DB::raw("IF(state = 1, 'Activo', 'Inactivo') AS state"))
            ->selectRaw("(
                SELECT co.name
                FROM cities AS c
                INNER JOIN states AS s
                ON s.id = c.state_id
                INNER JOIN countries AS co
                ON co.id = s.countrie_id
                WHERE c.id = users.citie_id)
                AS countrie")
            ->get()
            ->skip($request->skip)
            ->take($request->limit)
            ->values()
            ->all();

            return response()->json(['message' => 'Consultado correctamente', 'data' => $users], 200);
        } catch(\Exception $e) {
            return $e;
        }
    }
}
