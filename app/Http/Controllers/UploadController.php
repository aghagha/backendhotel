<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Http\Requests;

class UploadController extends Controller
{
    public function upload(){
    	$file = array('image' => Input::file('image'));
    }
}
