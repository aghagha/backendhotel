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

use App\TransaksiHotel;

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
            $service->call('logout', [$data]);
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

        $hotelcount = count($GLOBALS['hotels']->hotels);
        if($hotelcount < 10)
            $nextpage = 0;
        else $nextpage = 1;

        $parameters = [
            'keyword' => $keyword,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'page'      => 1,
            'nextpage'  => $nextpage
        ];

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

        if(Input::get('page') == '')
            $page = '1';
        else $page = Input::get('page');

        $mainservicedata = [
            'signature' => $GLOBALS['signature'],
            'agentid'   => $GLOBALS['agentid'],
            'keyword'   => Input::get('keyword'),
            'startdate' => Input::get('startdate'),
            'enddate'   => Input::get('enddate'),
            'star'      => '',
            'price'     => '',
            'foreign'   => '',
            'page'      => $page
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

        $hotelcount = count($GLOBALS['hotels']->hotels);
        if($hotelcount < 10)
            $nextpage = 0;
        else $nextpage = 1;
        
        $parameters = [
            'keyword'   => $keyword,
            'startdate' => $startdate,
            'enddate'   => $enddate,
            'page'      => $page,
            'nextpage'  => $nextpage
        ];

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

        return $parameters;
        // var_dump($parameters);
    }
    
    public function gethotels(Request $request){
        $parameters = $this->gethotelsbase($request->input('keyword'), $request->input('startdate'), $request->input('enddate'));
        
        return view('hotel.listHotel', ['hotels'=>$GLOBALS['hotels'], 
                                        'parameters'=>$parameters ]);
    }

    public function getRoomBase($hotelid, $startdate, $enddate){
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

        // echo "<pre>";
        // print_r($GLOBALS['rooms']);  
        // echo "</pre>";
// 
        return $GLOBALS['rooms'];

        // return view('hotel.hotelRoom',['rooms'=>$GLOBALS['rooms'],
                                        // 'signature'=>$GLOBALS['signature'],
                                        // 'agentid'=>$GLOBALS['agentid']]);
    }

    public function getRoomAvailability($hotelid, $startdate, $enddate){
        $this->getRoomBase($hotelid,$startdate,$enddate);

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

        return $GLOBALS['output'];

        // return view('hotel.addHotelGuest',['output'=>$GLOBALS['output'],
                                        // 'signature'=>$signature,
                                        // 'agentid'=>$agentid]);
    } 

    public function addGuest(){
        $this->mainService();

        $sellkeys = Input::get('sellkey');
        $guestname = Input::get('guestname');
        $guesttitle = Input::get('guesttitle');
        $guestrequests = Input::get('specialrequests');

        $i = 0;
        foreach ($sellkeys as $s) {
            $roomguests[$i]['sellkey'] = $s;
            $roomguests[$i]['guestname'] = $guestname;
            $roomguests[$i]['guesttitle'] = $guesttitle;
            $j=0;
            if($guestrequests !== null)
                foreach ($guestrequests as $gr) {
                    $roomguests[$i]['guestrequests'][$j]['requestid'] = $gr;
                    $roomguests[$i]['guestrequests'][$j]['requestdesc'] = Input::get('specialreqdesc')[$gr-1];
                    $roomguests[$i]['guestrequests'][$j++]['additionaltext'] = Input::get('additionaltext'.$gr);
                }
            else {
                $roomguests[$i]['guestrequests'][0]['requestid']='';
                $roomguests[$i]['guestrequests'][0]['requestdesc']='';
                $roomguests[$i]['guestrequests'][0]['additionaltext']='';
            }
            break;//////ini buat banyak kamar
        }

        $hotelid = explode('~', $sellkeys[0])[0];

        $data = [
            'signature' => Input::get('signature'),
            'reservationtoken' => Input::get('reservationtoken'),
            'agentid' => Input::get('agentid'),
            'hotelid' => $hotelid,
            'startdate' => Input::get('startdate'),
            'enddate' => Input::get('enddate'),
            'foreign' => Input::get('foreign'),
            'roomguests' => $roomguests
        ];

        SoapWrapper::service('mainservice', function($service) use ($data){
            $GLOBALS['output'] = $service->call('addguest', [$data]);
        });

        return $GLOBALS['output'];

        // return view('hotel.commitBooking',['output'=>$GLOBALS['output'],
                                            // 'signature'=>Input::get('signature'),
                                            // 'agentid'=>Input::get('agentid')]);
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

        return $GLOBALS['output'];

        // return view('hotel.booked', ['output'=>$GLOBALS['output']]);
    }

    public function getCommit(){
        $transaksihotel = TransaksiHotel::all();

        return json_encode($transaksihotel);
    }

    public function getBooking($bookingnumber){
        $this->declareWebService();

        $data = [
            'signature'=>$GLOBALS['signature'],
            'agentid'=>$GLOBALS['agentid'],
            'bookingnumber'=>$bookingnumber
        ];

        SoapWrapper::service('mainservice', function($service) use ($data){
            $GLOBALS['output'] = $service->call('getbooking', [$data]);
        });
        // echo "<pre>";
        // print_r($GLOBALS['output']);
        // echo "</pre>";
        return view('transaksi.bookingdetail',['detail'=>$GLOBALS['output']]);
    }

    public function gethotelsmobile(Request $request){
        $parameters = $this->gethotelsbase($request->input('keyword'), $request->input('startdate'), $request->input('enddate'));
        $outputs['hotels']=$GLOBALS['hotels'];
        $outputs['parameters']=$parameters;

        return json_encode($outputs);
    }

    public function getRoomAvailabilityMobile(){
        $hotelid = Input::get('hotelid');
        $startdate = Input::get('startdate');
        $enddate = Input::get('enddate');
        
        $output = $this->getRoomBase($hotelid,$startdate,$enddate);
        $output->signature = $GLOBALS['signature'];
        $output->agentid = $GLOBALS['agentid'];

        return json_encode($output);
    }

    public function sellRoomMobile(){
        $output = $this->sellRoom();
        $output->signature = Input::get('signature');
        $output->agentid = Input::get('agentid');

        return json_encode($output);
    }

    public function addGuestMobile(){
        $output = $this->addGuest();
        $output->signature = Input::get('signature');
        $output->agentid = Input::get('agentid');

        return json_encode($output);
    }

    public function commitBookingMobile(){
        $output = $this->commitBooking();

        //store to DB
        $transaksihotel = new TransaksiHotel;
        $transaksihotel->bookingnumber = $output->bookingnumber;
        $transaksihotel->booktime = $output->bookedtime;
        $transaksihotel->namatamu = $output->bookedrooms[0]->guesttitle.' '.$output->bookedrooms[0]->guestname;
        $transaksihotel->hotel = $output->hotel->hotelname;
        $transaksihotel->kamar = $output->bookedrooms[0]->roomname;
        $transaksihotel->checkin = $output->checkin;
        $transaksihotel->checkout = $output->checkout;
        $transaksihotel->totalharga = $output->totalpayment;
        $transaksihotel->status = $output->bookingstatus;
        $transaksihotel->save();

        return json_encode($output);
    }

    public function storeCommit(){
        $transaksihotel = new TransaksiHotel;
        $transaksihotel->bookingnumber = '$bookingnumber';
        $transaksihotel->booktime = '$booktime';
        $transaksihotel->namatamu = '$namatamu';
        $transaksihotel->hotel = '$hotel';
        $transaksihotel->kamar = '$kamar';
        $transaksihotel->checkin = '$checkin';
        $transaksihotel->totalharga = '$totalharga';
        $transaksihotel->status = '$status';
        $transaksihotel->save();
    }

    public function getToken(){
        return Response::json(['token'=>csrf_token()]);
    }
}

