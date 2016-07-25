@extends('base.base')

@section('title', 'Transaksi Hotel - Detail Booking')

@section('content')
<?php $now = 'transaksi'; ?>
	@include('base.navbar')

	@include('base.header')


	@include('base.sidebar')
	<div class="mainbar">
  
      <!-- Page heading -->
      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-home"></i> Transaksi Hotel</h2><div class="clearfix"></div>

  	</div>	
  	 <div class="matter" style="padding:10px; padding-top:0px;">
        <div class="container" style="padding:10px; padding-top:0px;">
          <div class="row widget">
            <div class="widget-head">
              <div class="pull-left">
                <h2>
                  Detail Booking
                </h2>
              </div>
              <div class="widget-icons pull-right">
                <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                <a href="#" class="wclose"><i class="fa fa-times"></i></a>
              </div> 
              <div class="clearfix"></div>
            </div>
            <div class="row">
            </div>
            <div class="widget-content">
              <div class="padd">
                <h2>Nomor booking:<strong> {{$detail->bookingnumber}}</strong></h2>
                <hr>
                <div>
                  <h3>Detail booking</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Status</td>
                        <td>{{$detail->bookingstatus}}</td>
                      </tr>
                      <tr>
                        <td>Booked time</td>
                        <td>{{$detail->bookedtime}}</td>
                      </tr>
                      <tr>
                        <td>Booked by</td>
                        <td>{{$detail->bookedby}}</td>
                      </tr>
                      <tr>
                        <td>Nama Pemesan</td>
                        <td>{{$detail->bookedrooms[0]->guesttitle}} {{$detail->bookedrooms[0]->guesttitle}}</td>
                      </tr>
                      <tr>
                        <td>Hotel</td>
                        <td>{{$detail->hotel->hotelname}}</td>
                      </tr>
                      <tr>
                        <td>Kamar</td>
                        <td>{{$detail->bookedrooms[0]->quantity}} kamar {{$detail->bookedrooms[0]->roomname}}</td>
                      </tr>
                      <tr>
                        <td>Checkin</td>
                        <td>{{$detail->checkin}}</td>
                      </tr>
                      <tr>
                        <td>Checkout</td>
                        <td>{{$detail->checkout}}</td>
                      </tr>
                      <tr>
                        <td>Malam</td>
                        <td>{{$detail->night}}</td>
                      </tr>
                      <tr>
                        <td>Total Pembayaran</td>
                        <td>{{$detail->totalpayment}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <hr>
                <div>
                  <h3>Data Hotel</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Nama</td>
                        <td>{{$detail->hotel->hotelname}}</td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>{{$detail->hotel->address}}</td>
                      </tr>
                      <tr>
                        <td>Kota</td>
                        <td>{{$detail->hotel->city}}</td>
                      </tr>
                      <tr>
                        <td>Telepon</td>
                        <td>{{$detail->hotel->phone}}</td>
                      </tr>
                      <tr>
                        <td>Fax</td>
                        <td>{{$detail->hotel->fax}}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>{{$detail->hotel->email}}</td>
                      </tr>
                      <tr>
                        <td>Bintang</td>
                        <td>{{$detail->hotel->star}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div>
                  <h3>Data Kamar</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Kode</td>
                        <td>{{$detail->bookedrooms[0]->roomcode}}</td>
                      </tr>
                      <tr>
                        <td>Name</td>
                        <td>{{$detail->bookedrooms[0]->roomname}}</td>
                      </tr>
                      <tr>
                        <td>Harga</td>
                        <td>{{$detail->bookedrooms[0]->sellprice}}</td>
                      </tr>
                      <tr>
                        <td>Diskon</td>
                        <td>{{$detail->bookedrooms[0]->discount}}</td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td>{{$detail->bookedrooms[0]->subtotal}}</td>
                      </tr>
                      <tr>
                        <td>Fasilitas</td>
                        <td>@foreach($detail->bookedrooms[0]->facilities as $f) {{$f}}<br> @endforeach </td>
                      </tr>
                      <tr>
                        <td>Request</td>
                        <td>@foreach($detail->bookedrooms[0]->specialrequests as $sr) {{$sr}}<br> @endforeach </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <hr>
                <div>
                  <h3>Data Agent</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>ID</td>
                        <td>{{$detail->agentdata->agentid}}</td>
                      </tr>
                      <tr>
                        <td>Nama</td>
                        <td>{{$detail->agentdata->name}}</td>
                      </tr>
                      <tr>
                        <td>Kontak</td>
                        <td>{{$detail->agentdata->contact}}</td>
                      </tr>
                      <tr>
                        <td>Telepon</td>
                        <td>{{$detail->agentdata->phone}}</td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>{{$detail->agentdata->address}}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>{{$detail->agentdata->email}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <hr>
              </div>
            </div>
          </div> 
        </div>
    </div>

    <!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->
   <div class="clearfix"></div>

</div>
<!-- Content ends -->

<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2012 | <a href="#">Your Site</a> </p>
      </div>
    </div>
  </div>
</footer>   

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

@endsection