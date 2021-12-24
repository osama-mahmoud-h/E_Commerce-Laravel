<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
####################### start the routes of localization #######################

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	// ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP 
	Route::get('/', function()
	{
		return view('site.home');
	});
});

####################### end the routes of localization #######################


Route::get('/', "SiteController@index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post("/subscribe","SiteController@subscribe")->name("subscribe");



