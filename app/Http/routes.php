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

Route::post('hotel/search', 
	['as'=>'search', 'uses' => 'SoapController@gethotels']);
Route::get('hotel/committed',
	['as'=>'hotel.committed','uses'=>'SoapController@getCommit']);
Route::get('hotel/getroom/{hotelid}/{stardate}/{enddate}', 
	['as'=> 'hotel.getroom', 'uses'=>'SoapController@getRoomAvailability']);
Route::post('hotel/sellroom',
	['as'=>'hotel.sellroom', 'uses'=>'SoapController@sellRoom']);
Route::post('hotel/addguest',
	['as'=>'hotel.addguest', 'uses'=>'SoapController@addGuest']);
Route::post('hotel/commitbooking',
	['as'=>'hotel.commitbooking','uses'=>'SoapController@commitBooking']);
Route::get('htoel/transaksi',
	['as'=>'hotel.transaksihotel','uses'=>'TransaksiController@getTransaksi']);

Route::post('hotel/m/search', 
	['as'=>'mobilesearch','uses'=>'SoapController@gethotelsmobile']);
Route::post('hotel/m/getroom',
	['as'=>'hotel.m.getroom', 'uses'=>'SoapController@getRoomAvailabilityMobile']);
Route::post('hotel/m/sellroom',
	['as'=>'hotel.m.sellroom', 'uses'=>'SoapController@sellRoomMobile']);
Route::post('hotel/m/addguest',
	['as'=>'hotel.m.addguest', 'uses'=>'SoapController@addGuestMobile']);
Route::post('hotel/m/commitbooking',
	['as'=>'hotel.m.commitbooking','uses'=>'SoapController@commitBookingMobile']);


// Route::get('images', function(){
// 	return view('hotel.hotelImages');
// });
// Route::get('/',function(){
// 	return 'Haryono';
// });


// Route::get('mobilesearch/{keyword?}/{stardate?}/{enddate?}', ['as' => 'mobile.index', 'uses' => 'SoapController@index']);




