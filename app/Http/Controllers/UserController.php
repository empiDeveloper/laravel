<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\GetUsersRequest;

class UserController extends Controller
{
    public function getUsers(GetUsersRequest $request)
    {
        try {
            $users = User::select('id', 'estado', 'name')
            ->get()
            ->skip($request->skip)
            ->take($request->limit)
            ->values()
            ->all();

            return response(['message' => 'Consultado correctamente', 'result' => $users], 200);
        } catch(\Exception $e) {
            return $e;
        }
    }
}
