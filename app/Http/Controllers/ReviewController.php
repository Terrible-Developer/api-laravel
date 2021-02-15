<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::all();
    }

    public function store(Request $request)
    {
        //Verifica se o filme já não foi avaliado pelo usuário da request
        if(Review::where('id_movie', '=', $request->id_movie, 'AND', 'id_user', '=', $request->id_user)->count() > 0){
            return 'This movie has already been reviewed!';
        }
        else{
            return Review::create($request->all());
        }
    }

    public function show($id)
    {
        return Review::find($id);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        $review->update($request->all());
        return $review;
    }

    public function destroy($id)
    {
        return Review::destroy($id);
    }
}
