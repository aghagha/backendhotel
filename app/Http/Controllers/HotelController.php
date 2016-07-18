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
        $fileDestination = 'public/uploads/'.$hotelid;
        $files = File::files($fileDestination);

        if(File::exists('public/uploads/'.$hotelid.'/thumb/'.$hotelid.'__thumbnail'.'.jpg')){
            $thumb = 'public/uploads/'.$hotelid.'/thumb/'.$hotelid.'__thumbnail'.'.jpg';
        } else { 
            $thumb ='public/uploads/No_Image_Available.png';
        }

    	return view('hotel.hotelImages', ['hotelid'=>$hotelid,
    									'hotelname'=>$hotelname,
    									'city'=>$city,
    									'website'=>$website,
                                        'thumb'=>$thumb])
    				->with('images', $files);
    }

    public function getImages($hotelid){
    	$images = Hotelimage::where('hotelid', "=", $hotelid)
    						->get();

    	return json_encode($images);
    }
}
