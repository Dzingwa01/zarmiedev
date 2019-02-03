<?php

use Illuminate\Http\Request;

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
Route::get('get-current-orders','OrdersApiController@getCurrentOrders');
Route::get('get-all-orders','OrdersApiController@getAllOrders');
Route::get('accept-order/{order}','OrdersApiController@acceptOrder');
Route::get('decline-order/{order}','OrdersApiController@declineOrder');
Route::get('get-accepted-orders','OrdersApiController@getAcceptedOrders');
Route::get('get-declined-orders','OrdersApiController@declinedOrders');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes
});
