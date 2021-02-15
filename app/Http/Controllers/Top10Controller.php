<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Movie;

class Top10Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $movies = DB::table('movies')->get();
        $reviews = array();
        foreach($movies as $movie){
            $currentMovieReviews = DB::table('reviews')->where('id_movie', $movie->id)->get();
            foreach($currentMovieReviews as $review){
                echo $review->rating;
            }
        }
        //echo $reviews;
    }
}
