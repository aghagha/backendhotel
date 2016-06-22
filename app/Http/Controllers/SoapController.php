<?php

namespace App\Http\Controllers;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Session;
use Input;
use Validator;
use Redirect;
use File;

use App\Http\Requests;

class SoapController extends Controller
{
    public function login(){
    	$GLOBALS['username'] = 'testcomapi';
		$GLOBALS['agentid'] = '3709';
		$GLOBALS['apikey'] = '343702b1ce99dd8add93d58b4fac4';
		$GLOBALS['sessionwsdl'] = 'https://b2b.haryonotours.co.id:443/apiv1-dev/index.php/sessionservice?wsdl';
	    $GLOBALS['servicewsdl'] = 'https://b2b.haryonotours.co.id:443/apiv1-dev/index.php/webservice?wsdl';

    	SoapWrapper::add(function ($service) {
            $service
                ->name('session')
                ->wsdl($GLOBALS['sessionwsdl']);
        });

        $data = [
            'username' => $GLOBALS['username'],
            'agentid'  => $GLOBALS['agentid'],
            'apikey'   => $GLOBALS['apikey'],
            'hashkey'  => ''
        ];

        SoapWrapper::service('session', function ($service) use ($data) {
            // $curr_session['signature'] = 
            $GLOBALS['signature'] = $service->call('login', [$data])->signature;
        });

        return;
    }

	public function logout(){
		$data = [
            'signature' => $GLOBALS['signature']
        ];

        SoapWrapper::service('session', function ($service) use ($data) {
            // $curr_session['signature'] = 
            //var_dump($service->call('logout', [$data]));
        });

        return;
    }    

    public function index($keyword = null, $startdate = null, $enddate = null){
    	$this->login();
    	SoapWrapper::add(function ($service) {
            $service
                ->name('mainservice')
                ->wsdl($GLOBALS['servicewsdl'])
                ->trace(true);
        });

        if(!$keyword)
            $keyword = '';
        if(!$startdate)
            $startdate = Carbon::now('Asia/Jakarta')->toDateString();
        if(!$enddate)
            $enddate = Carbon::tomorrow('Asia/Jakarta')->toDateString();

        $parameters = [
            'keyword' => $keyword,
            'startdate' => $startdate,
            'enddate' => $enddate
        ];

        $mainservicedata = [
        	'signature' => $GLOBALS['signature'],
        	'agentid'	=> $GLOBALS['agentid'],
        	'keyword'	=> $keyword,
        	'startdate'	=> $startdate,
        	'enddate'	=> $enddate,
        	'star'		=> '',
        	'price'		=> '',
        	'foreign'	=> '',
        	'page'		=> ''
        ];

        SoapWrapper::service('mainservice', function($service) use ($mainservicedata){
        	// var_dump($service->call('search',[$mainservicedata]));
        	$GLOBALS['hotels'] = $service->call('search',[$mainservicedata]);
            // var_dump($service->getFunctions());
        });

        foreach ($GLOBALS['hotels']->hotels as $hotel ) {
            if(File::exists('uploads/'.$hotel->hotelid.'/thumb/'.$hotel->hotelid.'__thumbnail'.'.jpg')){
                $hotel->thumb = '/uploads/'.$hotel->hotelid.'/thumb/'.$hotel->hotelid.'__thumbnail'.'.jpg';
            } else { 
                $hotel->thumb ='/uploads/No_Image_Available.png';
            }

            if(File::exists('uploads/'.$hotel->hotelid.'/')){
                $hotel->images = File::files('uploads/'.$hotel->hotelid.'/');
            }
            
        }

        $this->logout();

        return view('hotel.indexhotel', ['hotels'=>$GLOBALS['hotels'], 'parameters'=>$parameters]);
    }

    public function gethotels(){

        $this->login();

        $mainservicedata = [
            'signature' => $GLOBALS['signature'],
            'agentid'   => $GLOBALS['agentid'],
            'keyword'   => Input::get('keyword'),
            'startdate' => Input::get('startdate'),
            'enddate'   => Input::get('enddate'),
            'star'      => '',
            'price'     => '',
            'foreign'   => '',
            'page'      => ''
        ];

        SoapWrapper::add(function ($service) {
            $service
                ->name('mainservice')
                ->wsdl($GLOBALS['servicewsdl'])
                ->trace(true);
        });

        SoapWrapper::service('mainservice', function($service) use ($mainservicedata){
            try {
                $GLOBALS['hotels'] = $service->call('search',[$mainservicedata]);   
            } catch (Exception $e) {
                Session::flash('notfound', 'hotel not found');
                return view('hotel.indexhotel');
            }
        });

        $this->logout();

        foreach ($GLOBALS['hotels']->hotels as $hotel ) {
            $hotel->image_url = '/uploads/'.$hotel->hotelid.'__thumbnail'.'.jpg';
        }

        // var_dump(json_encode($GLOBALS['hotels']));
        return view('hotel.indexhotel', ['hotels'=>$GLOBALS['hotels'] ]);
    }

    public function getRoomAvailability($hotelid, $startdate, $enddate){
        $this->login();

        SoapWrapper::add(function ($service) {
            $service
                ->name('mainservice')
                ->wsdl($GLOBALS['servicewsdl'])
                ->trace(true);
        });

        $data = [
            'signature' => $GLOBALS['signature'],
            'agentid' => $GLOBALS['agentid'],
            'hotelid' => $hotelid,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'foreign' => ''
        ];

        SoapWrapper::service('mainservice', function($service) use ($data){
            // var_dump($service->call('search',[$mainservicedata]));
            $GLOBALS['rooms'] = $service->call('getroomavailability',[$data]);
        });

        return view('hotel.hotelRoom',['rooms'=>$GLOBALS['rooms']]);
    }

    public function mobileSearch($keyword = null, $startdate = null, $enddate = null){
        $this->login();
        if(!$keyword)
            $keyword = '';
        if(!$startdate)
            $startdate = Carbon::now('Asia/Jakarta')->toDateString();
        if(!$enddate)
            $enddate = Carbon::tomorrow('Asia/Jakarta')->toDateString();
        
    }
}
