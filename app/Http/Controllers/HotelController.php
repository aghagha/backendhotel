<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use File;
use App\Hotelimage;

class HotelController extends Controller
{
    public function editHotel($hotelid, $hotelname, $city, $website){
        $fileDestination = 'public/uploads/'.$hotelid.'/';
        $files = File::files($fileDestination);
        
    	// $images = json_decode($this->getImages($hotelid));
    	return view('hotel.editHotel', ['hotelid'=>$hotelid,
    									'hotelname'=>$hotelname,
    									'city'=>$city,
    									'website'=>$website])
    				->with('images', $files);
    }

    public function getImages($hotelid){
    	$images = Hotelimage::where('hotelid', "=", $hotelid)
    						->get();

    	return json_encode($images);
    }
}
