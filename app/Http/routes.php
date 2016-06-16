<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('hotel.indexhotel');
// });


Route::get('/', ['as' => 'index', 'uses' => 'SoapController@search']);

Route::post('hotel/upload', ['as' => 'upload', 'uses' => 'UploadController@upload']);
Route::get('hotel/{hotelid}/{hotelname}/{city}/{website}', ['as' => 'hotel.edit', 'uses'=>'HotelController@editHotel']);
Route::post('hotel/search', ['as'=>'search', 'uses' => 'SoapController@gethotels']);
