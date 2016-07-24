<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\TransaksiHotel;

class TransaksiController extends Controller
{
    public function getTransaksi(){
        $transaksi = DB::table('transaksihotel')->get();
        return view('transaksi.index',['transaksi'=>$transaksi]);
    }
}
