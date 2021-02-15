<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\Top10Controller;


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

/*Rotas padrões automáticas*/
Route::apiResource('movies', 'MovieController')->middleware('auth');
Route::apiResource('categories', 'CategoryController')->middleware('auth');
Route::apiResource('users', 'UserController')->middleware('auth');
Route::apiResource('actors', 'ActorController')->middleware('auth');
Route::apiResource('reviews', 'ReviewController')->middleware('auth');
Route::apiResource('movie-actors', 'MovieActorController')->middleware('auth');
Route::apiResource('movie-categories', 'MovieCategoryController')->middleware('auth');


/*Rotas Customizadas*/
Route::post('/login', function(){
    $credentials = request()->only(['login', 'password']);

    $token = auth('api')->attempt($credentials);

    return $token;
});

Route::get('/create-user-mock', function(){
    $user = App\Models\User::create([
        'login' => 'email1',
        'password' => Hash::make('password'),
        'name' => 'Test Name'
    ]);
    return $user;
});

//Route::get('/show-top', 'Top10Controller'); //Não funcionando;
//Route::get('/find-movies', 'SearchController');
Route::middleware('auth')->get('/find-movies', 'SearchController'); //Versão com autenticação

/*Teste de autenticação, aproveitando como rota para pegar as informações do usuário atualmente logado*/
Route::middleware('auth')->get('/logged-user', function(){
    return auth()->user();
});
