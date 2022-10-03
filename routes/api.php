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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/taxes', 'App\Http\Controllers\TaxesController@index');
Route::post('/taxes/store', 'App\Http\Controllers\TaxesController@store');
Route::get('/taxes/{id?}', 'App\Http\Controllers\TaxesController@show');
Route::put('/taxes/update/{id?}', 'App\Http\Controllers\TaxesController@update');
Route::delete('/taxes/{id?}', 'App\Http\Controllers\TaxesController@destroy');

Route::get('/items', 'App\Http\Controllers\ItemsController@index');
Route::post('/items/store', 'App\Http\Controllers\ItemsController@store');
Route::put('/items/update/{id?}', 'App\Http\Controllers\ItemsController@update');
Route::delete('/items/{id?}', 'App\Http\Controllers\ItemsController@destroy');