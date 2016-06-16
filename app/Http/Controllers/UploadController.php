<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use App\Http\Requests;

class UploadController extends Controller
{
    public function upload(){
    	$file = array('image' => Input::file('image'));
    	var_dump(Input::all());
    	$hotelid = Input::get('hotelid');
    	$isThumbnail = Input::get('thumbnail');
    	$rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
		
		$validator = Validator::make($file, $rules);
		if ($validator->fails()) {
		    // send back to the page with the input data and errors
		    return Redirect::to('hotel.edit')->withInput()->withErrors($validator);
		}
		
		$destinationPath = 'uploads/';
		$originalName = Input::file('image')->getClientOriginalName();
		$extension = Input::file('image')->getClientOriginalExtension();

		if($isThumbnail == 'yes'){
			$fileName = $hotelid.'__thumbnail'.'.'.$extension;
		} else {
			$fileName = $hotelid.'__'.$originalName.'.'.$extension;
		}
		Input::file('image')->move($destinationPath, $fileName);

		return Redirect::route('hotel.edit', array('hotelid' => $hotelid,
													'hotelname'=> Input::get('hotelname'),
													'city'=> Input::get('city'),
													'website'=> Input::get('website') ));
    }
}
