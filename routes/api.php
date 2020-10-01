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

Route::post('/evenement', 'EvenementController@store');

Route::get('/evenement/{hash}', 'EvenementController@show');
Route::post('/evenement/{hash}/vote', 'VoteController@store');

Route::patch('/evenement/{hashAdmin}', 'EvenementController@update');
Route::get('/evenement/{hashAdmin}/admin', 'EvenementController@showAdmin');
Route::delete('/evenement/{hashAdmin}', 'EvenementController@destroy');
Route::post('/evenement/{hashAdmin}/date', 'DateController@store');
// Route::patch('/evenement/{hashAdmin}/date/{id}', 'DateController@update');

Route::get('/evenements', 'EvenementController@index');
Route::delete('/evenements/delete', 'EvenementController@destroyAll');
