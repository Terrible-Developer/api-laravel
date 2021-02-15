<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Movie;
use App\Models\Actor;
use App\Models\Category;


class SearchController extends Controller
{

    public function __invoke(Request $request)
    {
        $movies = DB::table(DB::raw('movies', 'actors', 'categories', 'movie_actors', 'movie_categories'))
                ->join('movie_actors', 'movies.id', '=', 'movie_actors.id_movie')
                ->join('movie_categories', 'movies.id', '=', 'movie_categories.id_movie')
                ->join('actors', 'actors.id', '=', 'movie_actors.id_actor')
                ->join('categories', 'categories.id', '=', 'movie_categories.id_category')
                ->select('movies.title')
                ;
        if($request->all() == null){
            return $movies->get();
        }
        else{
            if($request->movie_title != null){
                //Considerando que só tá lendo a string exata, faz sentido deixar só o primeiro resultado
                $movies = $movies->where('movies.title', '=', $request->movie_title)->take(1);
            }
            if($request->actor_name != null){
                $movies = $movies->where('actors.name', '=', $request->actor_name);
            }
            if($request->movie_category != null){
                $movies = $movies->where('categories.category_name', '=', $request->movie_category)->distinct();
            }
            return $movies->get();
        }
    }
}
