<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test-route', function(){
    return ['Filme 1' => 'Star Wars IV: A New Hope', 'Filme 2' => 'Hellraiser'];
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});