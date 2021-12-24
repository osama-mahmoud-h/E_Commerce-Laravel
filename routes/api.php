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
Route::group([],function(){
    Route::get('/pay','MyFatoorahController@payOrder')->name('fatoorh.pay');
    Route::get('/callback',function(){
        return 'success';
    });
    Route::get('/error',function(){
        return 'oops payment error!';
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
