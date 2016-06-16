<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HotelController extends Controller
{
    public function editHotel($hotelid, $hotelname, $city, $website){
    	return view('hotel.editHotel', ['hotelid'=>$hotelid,
    									'hotelname'=>$hotelname,
    									'city'=>$city,
    									'website'=>$website]);
    }
}
