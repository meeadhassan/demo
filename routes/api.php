\\\<?php

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
Route::group(['prefix' => 'products'], function () {
Route::get('index', 'API\ProductsController@index');
Route::post('store-product', 'API\ProductsController@store');
Route::get('show-product', 'API\ProductsController@show');
Route::post('update-product', 'API\ProductsController@update');
Route::post('delete-product', 'API\ProductsController@delete');
});



