@extends('base.base')

@section('title', 'Kamar Hotel')

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
                  Daftar Booking
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
                <div class="page-tables">
                  <div class="table-striped">
                    <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                      <thead>
                        <th>ID</th>
                        <th>Waktu Booking</th>
                        <th>Nomor Booking</th>
                        <th>Nama Tamu</th>
                        <th>Hotel</th>
                        <th>Kamar</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Detail</th>
                      </thead>
                      <tbody>
                        @foreach($transaksi as $t)
                          <tr style="border-bottom:2px solid rgba(208, 71, 200, 0.53);padding: 0px 3px;border-radius: 3px;">
                            <td> {{$t->id}} </td>
                            <td> {{$t->booktime}} </td>
                            <td> {{$t->bookingnumber}} </td>
                            <td> {{$t->namatamu}} </td>
                            <td> {{$t->hotel}} </td>
                            <td> {{$t->kamar}} </td>
                            <td> {{$t->checkin}} </td>
                            <td> {{$t->checkout}} </td>
                            <td> {{$t->totalharga}} </td>
                            <td> {{$t->status}} </td>
                            <td><a href=" {{route('hotel.getbooking', ['bookingnumber'=>$t->bookingnumber]) }} "><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a><br></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
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