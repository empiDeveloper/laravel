<?php

namespace App\Http\Controllers\Publications;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function getPublications(Request $request)
    {
        try {
            $search = $request->query('query');

            $data = Post::from('posts AS p')
            ->select(
                'p.id',
                'p.title',
                'p.description',
                'p.price',
                'p.created_at',
                'c.name AS city',
                's.name AS stateCity',
            )
            ->selectRaw("(SELECT users.name FROM users WHERE users.id = p.user_id) AS author")
            ->leftJoin('cities AS c', 'p.citie_id', 'c.id')
            ->join('states AS s', 'c.state_id', 's.id')
            ->when($search, function($query) use($search){
                $query->where('p.title', 'LIKE', "%$search%")
                ->orWhere('p.description', 'LIKE', "%$search%");
            })
            ->orderBy('p.created_at', 'desc')
            ->limit(20)
            ->get();

            return response()->json(["data" => $data], 200);
        } catch(\Exception $e){
            return response($e);
        }
    }
}
