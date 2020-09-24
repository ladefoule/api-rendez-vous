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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/evenement/{id}/vote', 'VoteController@store');
Route::post('/evenement/{id}/date', 'DateController@store');

Route::get('/evenement/{id}', 'EvenementController@show');
Route::post('/evenement', 'EvenementController@store');
Route::delete('/delete/{id}', 'EvenementController@destroy');
Route::patch('/evenement/{id}', 'EvenementController@update');

