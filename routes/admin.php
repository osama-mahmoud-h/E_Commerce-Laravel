<?php

use Illuminate\Support\Facades\Route;

Route::group([],function(){
// Dashboard
Route::get('/', 'HomeController@index')->name('dashboard');
// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

#######################################   Start MainCategory   #############################################
Route::group(['prefix'=>'main_categories','middleware'=>'admin.auth:admin'],function(){
    Route::get('/','MainCategoryController@index')->name('main_categories');
    Route::get('/create','MainCategoryController@create')->name('main_categories.create');
    Route::post('/store','MainCategoryController@store')->name('main_categories.store');
    Route::get('/edit/{id}','MainCategoryController@edit')->name('main_categories.edit');
    Route::post('/update/{id}','MainCategoryController@update')->name('main_categories.update');
    Route::get('/destroy/{id}','MainCategoryController@destroy')->name('main_categories.delete');
});
#######################################   End MainCategory   #############################################

#######################################   start SubCategory   #############################################
/*Route::group(['prefix'=>'sub_categories','middleware'=>'admin.auth:admin'],function(){
    Route::get('/','SubCategoryController@index')->name('sub_categories');
    Route::get('/create','SubCategoryController@create')->name('sub_categories.create');
    Route::post('/store','SubCategoryController@store')->name('sub_categories.store');
    Route::get('/edit/{id}','SubCategoryController@edit')->name('sub_categories.edit');
    Route::post('/update/{id}','SubCategoryController@update')->name('sub_categories.update');
    Route::get('/destroy/{id}','SubCategoryController@destroy')->name('sub_categories.delete');
});*/
#######################################   End SubCategory   #############################################

#######################################   start products   #############################################
Route::group(['prefix'=>'products','middleware'=>'admin.auth:admin'],function(){
    Route::get('/','ProductController@index')->name('products');
    Route::get('/create','ProductController@create')->name('products.create');
    Route::post('/store','ProductController@store')->name('products.store');
    Route::get('/edit/{id}','ProductController@edit')->name('products.edit');
    Route::post('/update/{id}','ProductController@update')->name('products.update');
    Route::get('/destroy/{id}','ProductController@destroy')->name('products.delete');
});
#######################################   End products   #############################################

#######################################   start offers   #############################################
Route::group(['prefix'=>'offers','middleware'=>'admin.auth:admin'],function(){
    Route::get('/','OfferController@index')->name('offers');
    Route::get('/create','OfferController@create')->name('offers.create');
    Route::post('/store','OfferController@store')->name('offers.store');
    Route::get('/edit/{id}','OfferController@edit')->name('offers.edit');
    Route::post('/update/{id}','OfferController@update')->name('offers.update');
    Route::get('/destroy/{id}','OfferController@destroy')->name('offers.delete');
});
#######################################   End offers   #############################################

});
