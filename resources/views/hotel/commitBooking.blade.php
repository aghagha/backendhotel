@extends('base.base')

@section('title', 'Kamar Hotel')

@section('content')
<?php $now = 'hotel'; ?>
	@extends('base.sidebar')

	@extends('base.header')


	@extends('base.navbar')
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
  	 <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

          <div class="row">
            <div class="col-md-12"> 
              <!-- List starts -->
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">
                    <h2>
                      Commit Booking
                    </h2>
                  </div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div> 
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd invoice">
                    <h3><strong>Data pemesanan</strong></h3>
                    <h4>
                      {{$output->hotel->hotelname}}<br>
                      {{$output->hotel->city}}<br>
                    </h4>
                    <p>
                      <div class="row">
                        <div class="col-md-2">Checkin</div>
                        <div class="col-md-10">{{$output->startdate}}</div>
                        
                        <div class="col-md-2">Checkout</div>
                        <div class="col-md-10">{{$output->enddate}}</div>
                        
                        <div class="col-md-2">Nama Kamar</div>
                        <div class="col-md-10">{{$output->reservationdata[0]->roomname}}</div>
                        
                        <div class="col-md-2">Jumlah</div>
                        <div class="col-md-10">{{$output->reservationdata[0]->quantity}}</div>

                        <div class="col-md-2">Harga</div>
                        <div class="col-md-10">{{$output->reservationdata[0]->sellprice}} - {{$output->reservationdata[0]->discount}}</div>
                      </div>
                    </p>
                    <hr>
                    <p>
                      <div class="row">
                        <div class="col-md-2">Pemesan</div>
                        <div class="col-md-10">{{$output->reservationdata[0]->guesttitle}} {{$output->reservationdata[0]->guestname}}</div>

                        <div class="col-md-2">Permintaan khusus</div>
                        <div class="col-md-10">
                          <?php $i = 1 ?>
                          @foreach($output->reservationdata[0]->guestrequests as $guestrequest)
                            {{$i++}}. {{$guestrequest->requestdesc}} {{@isset($guestrequest->additionaltext) ? $guestrequest->additionaltext : ''}}<br>
                          @endforeach
                        </div>
                      </div>
                    </p>
                    <br>
                    {{Form::open(array('url'=>'hotel/commitbooking', 'method'=>'POST'))}}
                      {{ Form::hidden('signature',$signature) }}
                      {{ Form::hidden('reservationtoken',$output->reservationtoken) }}
                      {{ Form::hidden('agentid',$agentid) }}
                      {{ Form::hidden('hotelid',$output->hotel->hotelid) }}
                      {{ Form::hidden('startdate',$output->startdate) }}
                      {{ Form::hidden('enddate',$output->enddate) }}
                      {{ Form::hidden('foreign','') }}
                      {{ Form::hidden('sellkey',$output->reservationdata[0]->roomsellcode) }}
                      {{ Form::submit('Tambahkan pesanan',array('class'=>'btn btn-primary')) }}
                    {{Form::close()}}
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