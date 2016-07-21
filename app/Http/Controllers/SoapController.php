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

    public function test(Request $request){
        $a['keyword']=$request->input('keyword');
        $a['startdate']=$request->input('startdate');

        var_dump($a);
    }

    public function sessionService(){
        $GLOBALS['sessionwsdl'] = 'https://b2b.haryonotours.co.id:443/apiv1-dev/index.php/sessionservice?wsdl';

        SoapWrapper::add(function ($service) {
            $service
                ->name('session')
                ->wsdl($GLOBALS['sessionwsdl']);
        });

        return;
    }

    public function mainService(){
        $GLOBALS['servicewsdl'] = 'https://b2b.haryonotours.co.id:443/apiv1-dev/index.php/webservice?wsdl';

        SoapWrapper::add(function ($service) {
            $service
                ->name('mainservice')
                ->wsdl($GLOBALS['servicewsdl'])
                ->trace(true);
        });

        return;
    }

    public function declareWebService(){
        $this->login();
        $this->mainService();

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
        $this->declareWebService();

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
            'agentid'   => $GLOBALS['agentid'],
            'keyword'   => $keyword,
            'startdate' => $startdate,
            'enddate'   => $enddate,
            'star'      => '',
            'price'     => '',
            'foreign'   => '',
            'page'      => ''
        ];

        SoapWrapper::service('mainservice', function($service) use ($mainservicedata){
            // var_dump($service->call('search',[$mainservicedata]));
            $GLOBALS['hotels'] = $service->call('search',[$mainservicedata]);
            // var_dump($service->getFunctions());
        });

        foreach ($GLOBALS['hotels']->hotels as $hotel ) {
            if(File::exists('public/uploads/'.$hotel->hotelid.'/thumb/'.$hotel->hotelid.'__thumbnail'.'.jpg')){
                $hotel->thumb = 'public/uploads/'.$hotel->hotelid.'/thumb/'.$hotel->hotelid.'__thumbnail'.'.jpg';
            } else { 
                $hotel->thumb ='public/uploads/No_Image_Available.png';
            }

            if(File::exists('public/uploads/'.$hotel->hotelid.'/')){
                $hotel->images = File::files('public/uploads/'.$hotel->hotelid);
            }
            
        }

        $this->logout();

        return view('hotel.listHotel', ['hotels'=>$GLOBALS['hotels'], 'parameters'=>$parameters]);
    }

    public function gethotelsbase($keyword, $startdate, $enddate){

        $this->login();

        $parameters = [
            'keyword'   => $keyword,
            'startdate' => $startdate,
            'enddate'   => $enddate
        ];

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
            if(File::exists('public/uploads/'.$hotel->hotelid.'/thumb/'.$hotel->hotelid.'__thumbnail'.'.jpg')){
                $hotel->thumb = 'public/uploads/'.$hotel->hotelid.'/thumb/'.$hotel->hotelid.'__thumbnail'.'.jpg';
            } else { 
                $hotel->thumb ='public/uploads/No_Image_Available.png';
            }

            if(File::exists('public/uploads/'.$hotel->hotelid.'/')){
                $hotel->images = File::files('public/uploads/'.$hotel->hotelid);
            }
            
        }

        // var_dump(json_encode($GLOBALS['hotels']));
        return $parameters;
    }
    
    public function gethotels(Request $request){
        $parameters = $this->gethotelsbase($request->input('keyword'), $request->input('startdate'), $request->input('enddate'));
        
        return view('hotel.listHotel', ['hotels'=>$GLOBALS['hotels'], 'parameters'=>$parameters ]);
    }

    public function gethotelsmobileOLD(){
        $parameters = $this->gethotelsbase($request->input('keyword'), $request->input('startdate'), $request->input('enddate'));
        $outputs['hotels']=$GLOBALS['hotels'];
        $outputs['parameters']=$parameters;

        return json_encode($outputs);
    }

    public function gethotelsmobile(Request $request){
        $parameters = $this->gethotelsbase($request->input('keyword'), $request->input('startdate'), $request->input('enddate'));
        $outputs['hotels']=$GLOBALS['hotels'];
        $outputs['parameters']=$parameters;

        return json_encode($outputs);
    }

    public function getRoomAvailability($hotelid, $startdate, $enddate){
        $this->declareWebService();

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

        return view('hotel.hotelRoom',['rooms'=>$GLOBALS['rooms'],
                                        'signature'=>$GLOBALS['signature'],
                                        'agentid'=>$GLOBALS['agentid']]);
    }

    public function sellRoom(){
        $this->mainService();

        $signature = Input::get('signature');
        $agentid = Input::get('agentid');
        $i=0;
        $quantity = Input::get('quantity');
        foreach ($quantity as $q) {
            if($q > 0){
                $roomsellkeys[$i] = array('sellkey' => Input::get('roomsellcode')[$i] ,
                                            'quantity' => $q) ;
                $i++;
            }
        }
        $sellkey = Input::get('roomsellcode');
        $dates = explode(':',explode('~', end($sellkey))[2]);
        $hotelid = explode('~', end($sellkey))[0];
        $startdate = $dates[0];
        $enddate = $dates[1];
        $data = [
            'signature' => $signature,
            'agentid' => $agentid,
            'hotelid' => $hotelid,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'foreign' => '',
            'roomsellkeys' => $roomsellkeys,
            'quantity' => $quantity
        ];
        

        
        SoapWrapper::service('mainservice', function($service) use ($data){
            $GLOBALS['output'] = $service->call('sellroom', [$data]);
        });


        // echo "<pre>";
        // print_r($GLOBALS['output']);  
        // echo "</pre>";
        return view('hotel.addHotelGuest',['output'=>$GLOBALS['output'],
                                        'signature'=>$signature,
                                        'agentid'=>$agentid]);
    } 

    public function addGuest(){
        $this->mainService();

        $roomguests[0]['sellkey']=Input::get('sellkey');
        $roomguests[0]['guestname']=Input::get('guestname');
        $roomguests[0]['guesttitle']=Input::get('guesttitle');
        $j=0;
        for($i=1;$i<=Input::get('nrequest');$i++){
            if(Input::get('guestrequests'.$i) == $i){
                $roomguests[0]['guestrequests'][$j]['requestid'] = Input::get('guestrequests'.$i);
                $roomguests[0]['guestrequests'][$j]['requestdesc'] = Input::get('requestredesc'.$i);
                $roomguests[0]['guestrequests'][$j]['additionaltext'] = Input::get('additionaltext'.$i);
                $j++;
            }
        }
        $sellkeys = Explode('~', Input::get('sellkey'));

        $data = [
            'signature' => Input::get('signature'),
            'reservationtoken' => Input::get('reservationtoken'),
            'agentid' => Input::get('agentid'),
            'hotelid' => $sellkeys[0],
            'startdate' => Input::get('startdate'),
            'enddate' => Input::get('enddate'),
            'foreign' => Input::get('foreign'),
            'roomguests' => $roomguests
        ];

        SoapWrapper::service('mainservice', function($service) use ($data){
            $GLOBALS['output'] = $service->call('addguest', [$data]);
        });

        // echo '<pre>';
        // print_r($GLOBALS['output']);
        // echo '</pre>';

        return view('hotel.commitBooking',['output'=>$GLOBALS['output'],
                                            'signature'=>Input::get('signature'),
                                            'agentid'=>Input::get('agentid')]);
    }  

    public function commitBooking(){
        $this->mainService();
        
        $commitsellkeys[0]['sellkey']=Input::get('sellkey');

        $data = [
            'signature' => Input::get('signature'),
            'reservationtoken' => Input::get('reservationtoken'),
            'agentid' => Input::get('agentid'),
            'hotelid' => Input::get('hotelid'),
            'startdate' => Input::get('startdate'),
            'enddate' => Input::get('enddate'),
            'foreign' => Input::get('foreign'),
            'commitsellkeys' => $commitsellkeys
        ];

        SoapWrapper::service('mainservice', function($service) use ($data){
            $GLOBALS['output'] = $service->call('commitbooking', [$data]);
        });

        $GLOBALS['signature'] = Input::get('signature');

        $this->sessionService();
        $this->logout();

        // echo '<pre>';
        // print_r($GLOBALS['output']);
        // echo'</pre>';

        return view('hotel.booked', ['output'=>$GLOBALS['output']]);
    }

    public function getToken(){
        return Response::json(['token'=>csrf_token()]);
    }
}

