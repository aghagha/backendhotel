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
Route::get('/', 
	['as' => 'index', 'uses' => 'SoapController@index']);

Route::get('index', function () {
    return view('hotel.index');
});

Route::get('list', 
	['as'=>'hotel.list', 'uses' => 'SoapController@index']);

Route::post('hotel/upload', 
	['as' => 'upload', 'uses' => 'UploadController@upload']);

Route::get('hotel/images/{hotelid}/{hotelname}/{city}/{website}', 
	['as' => 'hotel.images', 'uses'=>'HotelController@editHotel']);

// Route::get('images', function(){
// 	return view('hotel.hotelImages');
// });
// Route::get('/',function(){
// 	return 'Haryono';
// });


// Route::get('mobilesearch/{keyword?}/{stardate?}/{enddate?}', ['as' => 'mobile.index', 'uses' => 'SoapController@index']);


// Route::get('hotel/getroom/{hotelid}/{stardate}/{enddate}', ['as'=> 'hotel.getroom', 'uses'=>'SoapController@getRoomAvailability']);
// Route::post('hotel/sellroom',['as'=>'hotel.sellroom', 'uses'=>'SoapController@sellRoom']);

// Route::post('hotel/search', ['as'=>'search', 'uses' => 'SoapController@gethotels']);

