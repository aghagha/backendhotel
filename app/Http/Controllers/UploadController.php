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
    	$hotelid = array('hotelid' => Input::get('hotelid'));
    	// $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
		
		// $validator = Validator::make($file, $rules);
		// if ($validator->fails()) {
		//     // send back to the page with the input data and errors
		//     return Redirect::to('upload')->withInput()->withErrors($validator);
		//   }
		$destinationPath = 'uploads';
		$extension = Input::file('image')->getClientOriginalExtension();
		$fileName = $hotelid['hotelid'].'thumbnail'.'.jpg';
		Input::file('image')->move($destinationPath, $fileName);
		return Redirect::to('search');
    }
}
