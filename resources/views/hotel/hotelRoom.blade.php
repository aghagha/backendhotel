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
                      {{$rooms->hotel->hotelname}} Rooms
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
                    <div>
                      {!! Form::open(array('url'=>'hotel/sellroom', 'method'=>'POST')) !!}
          						@foreach($rooms->rates as $roomrate )
                          <br>
                          
                          <h5>
                            <h4><strong>Ratecode: {{ $roomrate->ratecode }}</strong></h4>
                            No cancel: {{ $roomrate->nocancel }}<br>
                            Promo: {{ $roomrate->promo }}<br>
                            Rooms:
                          </h5>
                          
                          @foreach($roomrate->rooms as $room)
                            <p>
                              <div class="row">
                                <div class="col-md-5">
                                  <h5><strong>{{ $room->roomname }}</strong></h5> <br>
                                  {{ $room->pricecurrency }} {{ $room->sellprice }} <br>
                                  disc. {{ $room->pricecurrency }} {{ $room->discount }}<br>
                                  Ketersediaan kamar <strong>{{ $room->allotment }}</strong>
                                  <hr>
                                </div>
                                <div class="col-md-1">
                                  <?php $newrsc = explode('~', $room->roomsellcode);?>
                                  {{ Form::number('quantity[]','0',array('class'=>'form-control number'))}}
                                  {{ Form::hidden('roomsellcode[]', $room->roomsellcode ) }}
                                </div>
                              </div>
                              
                            </p>
                          @endforeach
          						@endforeach
                        {{ Form::hidden('signature', $signature) }}
                        {{ Form::hidden('agentid', $agentid) }}
                        <div class="row"><div class="col-md-6">{{ Form::submit('Pesan',array('class'=>'btn btn-block btn-primary')) }} </div></div>
                      {!! Form::close() !!}
          					</div>
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