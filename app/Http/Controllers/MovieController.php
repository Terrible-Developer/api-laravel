<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        //show
        return Movie::all();
    }

    public function store(Request $request)
    {
        //create
        return Movie::create($request->all());
    }

    public function show($id)
    {
        //show selected
        return Movie::find($id);
    }

    public function update(Request $request, $id)
    {
        //update
        $movie = Movie::find($id);
        $movie->update($request->all());
        return $movie;
    }

    public function destroy($id)
    {
        //delete
        return Movie::destroy($id);
    }
}
