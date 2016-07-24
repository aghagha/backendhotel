@extends('base.base')

@section('title', 'Kamar Hotel')

@section('content')
<?php $now = 'hotel'; ?>
	@include('base.navbar')

	@include('base.header')


	@include('base.sidebar')
	<div class="mainbar">
  
      <!-- Page heading -->
      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-home"></i> Dashboard</h2>

                <!-- Breadcrumb -->
                <div class="bread-crumb pull-right">
                  <a href="index.html"><i class="fa fa-home"></i> Admin</a> 
                  <!-- Divider -->
                  <span class="divider">/</span> 
                  <a href="#" class="bread-current">Dashboard</a>
                </div>

                <div class="clearfix"></div>

  	</div>	
  	 <div class="matter" style="padding:10px; padding-top:0px;">
        <div class="container" style="padding:10px; padding-top:0px;">
          <div class="row widget">
            <div class="widget-head">
              <div class="pull-left">
                <h2>
                  {{$rooms->hotel->hotelname}}
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
                @foreach($rooms->rates as $roomrate)
                <p>
                  <h3><strong>{{$roomrate->ratecode}}</strong></h3>
                  Bisa cancel:@if($roomrate->nocancel == 0) Ya<br>
                              @else Tidak<br>
                              @endif
                  @if($roomrate->promo == 0)Rate Normal
                  @else Rate Promo
                  @endif
                  <br>
                  <br>
                </p>
                <div class="page-tables">
                  <div class="table-striped">
                    <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                      <thead>
                        <th>Nama</th>
                        <th>Roomsellcode</th>
                        <th>Mata Uang</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Kapasitas</th>
                      </thead>
                      <tbody>
                        @foreach($roomrate->rooms as $room)
                          <tr style="border-bottom:2px solid rgba(208, 71, 200, 0.53);padding: 0px 3px;border-radius: 3px;">
                            <td> {{$room->roomname}} </td>
                            <td> {{$room->roomsellcode}} </td>
                            <td> {{$room->pricecurrency}} </td>
                            <td> {{$room->sellprice}} </td>
                            <td> {{$room->discount}} </td>
                            <td> {{$room->allotment}} </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                @endforeach
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