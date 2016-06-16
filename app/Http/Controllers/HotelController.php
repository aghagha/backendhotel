<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


use App\Hotelimage;

class HotelController extends Controller
{
    public function editHotel($hotelid, $hotelname, $city, $website){
    	$images = json_decode($this->getImages($hotelid));
    	return view('hotel.editHotel', ['hotelid'=>$hotelid,
    									'hotelname'=>$hotelname,
    									'city'=>$city,
    									'website'=>$website])
    				->with('images', $images);
    }

    public function getImages($hotelid){
    	$images = Hotelimage::where('hotelid', "=", $hotelid)
    						->get();

    	return json_encode($images);
    }
}
