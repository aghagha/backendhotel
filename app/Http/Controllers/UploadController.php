<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Intervention\Image\ImageManager;

use Session;
use Input;
use Validator;
use Redirect;

use App\Http\Requests;
use App\Hotelimage;

class UploadController extends Controller
{
    public function upload(){
    	$file = array('image' => Input::file('image'));
    	$hotelid = Input::get('hotelid');
    	$isThumbnail = Input::get('thumbnail');
    	$rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
		
		$validator = Validator::make($file, $rules);
		if ($validator->fails()) {
		    // send back to the page with the input data and errors
		    // return Redirect::ro('hotel.edit')->withInput()->withErrors($validator);
		    return Redirect::route('hotel.images', array('hotelid' => $hotelid,
													'hotelname'=> Input::get('hotelname'),
													'city'=> Input::get('city'),
													'website'=> Input::get('website')))
		    										->withErrors($validator);
		} else {
			if(Input::file('image')->isValid()){
				$destinationPath = public_path().'/uploads/'.$hotelid.'/';
				$originalName = Input::file('image')->getClientOriginalName();
				$extension = Input::file('image')->getClientOriginalExtension();

				if($isThumbnail == 'yes'){
					$fileName = $hotelid.'__thumbnail'.'.jpg';
					$destinationPath = $destinationPath.'thumb/';
				} else {
					$fileName = $hotelid.'__'.$originalName;
				}
				Input::file('image')->move($destinationPath, $fileName);

				// var_dump(Input::all());
				Session::flash('success', 'Upload successfully');
				// return Redirect::route('index');
				return Redirect::route('hotel.images', array('hotelid' => $hotelid,
															'hotelname'=> Input::get('hotelname'),
															'city'=> Input::get('city'),
															'website'=> Input::get('website') ));
			} else {
				Session::flash('error', 'uploaded file is not valid');
				return Redirect::route('hotel.images', array('hotelid' => $hotelid,
															'hotelname'=> Input::get('hotelname'),
															'city'=> Input::get('city'),
															'website'=> Input::get('website') ));
			}
		}
    }
}
