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
                    <h3>Status Booking<strong class="red"> {{$output->bookingstatus}}</strong></h3>
                    <hr>
                    <h4>
                      {{$output->hotel->hotelname}}<br>
                      {{$output->hotel->city}}<br>
                    </h4>
                    <hr>
                    <p>
                      <div class="row">
                        <div class="col-md-2">Booknumber</div>
                        <div class="col-md-10">{{$output->bookingnumber}}</div>

                        <div class="col-md-2">Checkin</div>
                        <div class="col-md-10">{{$output->checkin}}</div>
                        
                        <div class="col-md-2">Checkout</div>
                        <div class="col-md-10">{{$output->checkout}}</div>

                        <div class="col-md-2">Waktu boook</div>
                        <div class="col-md-10">{{$output->bookedtime}}</div>

                        <div class="col-md-2">Pemesan</div>
                        <div class="col-md-10">{{$output->bookedrooms[0]->guesttitle}} {{$output->bookedrooms[0]->guestname}}</div>
                        
                        <div class="col-md-2">Nama Kamar</div>
                        <div class="col-md-10">{{$output->bookedrooms[0]->roomname}}</div>
                        
                        <div class="col-md-2">Jumlah</div>
                        <div class="col-md-10">{{$output->bookedrooms[0]->quantity}}</div>

                        <div class="col-md-2">Request tambahan</div>
                        <div class="col-md-10">
                          <?php $i = 1?>
                          @foreach($output->bookedrooms[0]->specialrequests as $guestrequest)
                            {{$i++}}. {{$guestrequest}}<br>
                          @endforeach
                        </div>

                        <div class="col-md-2">Total pembayaran</div>
                        <div class="col-md-10">{{$output->bookedrooms[0]->pricecurrency}} {{$output->bookedrooms[0]->subtotal}}</div>
                      </div>
                    </p>
                   
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